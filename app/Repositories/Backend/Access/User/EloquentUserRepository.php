<?php
namespace App\Repositories\Backend\Access\User;

use App\Models\Access\User\User;
use App\Exceptions\GeneralException;
use App\Exceptions\Backend\Access\User\UserNeedsRolesException;
use App\Repositories\Backend\Access\Role\RoleRepositoryContract;
use App\Repositories\Frontend\Access\User\UserRepositoryContract as FrontendUserRepositoryContract;
use Mockery\CountValidator\Exception;

class EloquentUserRepository implements UserRepositoryContract
{
    protected $role;

    protected $user;

    /**
     * EloquentRoleRepository constructor.
     * @param RoleRepositoryContract $role
     * @param FrontendUserRepositoryContract $user
     */
    public function __construct(
        RoleRepositoryContract $role,
        FrontendUserRepositoryContract $user
    )
    {
        $this->role = $role;
        $this->user = $user;
    }

    /**
     * @param $id
     * @param bool $withRoles
     * @return mixed
     * @throws GeneralException
     */
    public function findOrThrowException($id, $withRoles = false)
    {
        if($withRoles){
            $user = User::with('roles')->withTrashed()->find($id);
        }else{
            $user = User::withTrashed()->find($id);
        }

        if(! is_null($user)){
            return $user;
        }

        throw  new GeneralException(trans('exceptions.backend.access.users.not_found'));
    }

    /**
     * @param $per_page
     * @param int $status
     * @param string $order_by
     * @param string $sort
     * @return mixed
     */
    public function getUsersPaginated($per_page, $status = 1, $order_by = 'id', $sort = 'asc')
    {
        return User::where('status', $status)
            ->orderBy($order_by,$sort)
            ->paginate($per_page);
    }

    /**
     * @param $per_page
     * @return mixed
     */
    public function getDeletedUsersPaginated($per_page)
    {
        return User::onlyTrashed()
            ->paginate($per_page);
    }

    /**
     * @param string $order_by
     * @param string $sort
     * @return mixed
     */
    public function getAllUsers($order_by = 'id', $sort = 'asc')
    {
        return User::orderBy($order_by, $sort)
            ->get();
    }

    /**
     * @param $input
     * @param $roles
     * @param $permissions
     * @return bool
     * @throws GeneralException
     * @throws UserNeedsRolesException
     */
    public function create($input, $roles, $permissions)
    {
        $user = $this->createUserStub($input);

        if($user->save()){
            //User Created. Validate Roles
            $this->validateRoleAmount($user, $roles['assignees_roles']);

            //Attach new roles
            $user->attachRoles($roles['assignees_roles']);

            //Attach other permissions
            $user->attachPermissions($permissions['permission_user']);

            //Send confirmation email if request
            if(isset($input['confirmation_email']) && $user->confirmed == 0){
                $this->user->sendConfirmationEmail($user->id);
            }

            return true;
        }

        throw  new GeneralException(trans('exceptions.backend.access.users.create_error'));
    }

    /**
     * @param $id
     * @param $input
     * @param $roles
     * @param $permissions
     * @return bool
     * @throws GeneralException
     */
    public function update($id, $input, $roles, $permissions)
    {
        $user = $this->findOrThrowException($id);
        $this->checkUserByEmail($input, $user);

        if($user->update($input)){
            $user->status = isset($input['status']) ? 1 : 0;
            $user->confirmed = isset($input['confirmed']) ? 1:0;
            $user->save();

            $this->checkUserRolesCount($roles);
            $this->flushRoles($roles, $user);
            $this->flushPermissions($permissions, $user);

            return true;
        }

        throw new GeneralException(trans('exceptions.backend.access.users.update_error'));
    }

    /**
     * @param $id
     * @param $input
     * @return bool
     * @throws GeneralException
     */
    public function updatePassword($id, $input)
    {
        $user = $this->findOrThrowException($id);
        $user->password = bcrypt($input['password']);

        if($user->save()){
            return true;
        }

        throw new GeneralException(trans('exceptions.backend.access.users.update_password_error'));
    }

    /**
     * @param $id
     * @return bool
     * @throws GeneralException
     */
    public function destroy($id)
    {
        if(auth()->id() == $id){
            throw new GeneralException(trans('exceptions.backend.access.users.cant_delete_self'));
        }

        $user = $this->findOrThrowException($id);
        if($user->delete()){
            return true;
        }

        throw new GeneralException(trans('exceptions.backend.access.user.delete_error'));
    }

    /**
     * @param $id
     * @throws GeneralException
     * @return boolean|null
     */
    public function delete($id)
    {
        $user = $this->findOrThrowException($id, true);

        //Detach all roles & permissions
        $user->detachRoles($user->roles);
        $user->detachPermissions($user->permissions);

        try{
            $user->forceDelete();
        }catch(\Exception $e){
            throw new GeneralException($e->getMessage());
        }
    }

    /**
     * @param $id
     * @return bool
     * @throws GeneralException
     */
    public function restore($id)
    {
        $user = $this->findOrThrowException($id);

        if($user->restore()){
            return true;
        }

        throw new GeneralException(trans('exceptions.backend.access.users.restore_error'));
    }

    /**
     * @param $id
     * @param $status
     * @return bool
     * @throws GeneralException
     */
    public function mark($id, $status)
    {
        if(access()->id() == $id && $status == 0){
            throw new GeneralException(trans('exceptions.backend.access.users.cant_deactivate_self'));
        }

        $user           = $this->findOrThrowException($id);
        $user->status   = $status;

        if($user->save()){
            return true;
        }

        throw  new GeneralException(trans('exceptions.backend.access.users.mark_error'));
    }
    /**
     * @param $permissions
     * @param $user
     */
    private function flushPermissions($permissions, $user)
    {
        //Flush permissions out,then add array of new ones if any
        $user->detachPermissions($user->permissions);
        if(count($permissions['permission_user']) > 0){
            $user->attachPermissions($permissions['permission_user']);
        }
    }
    /**
     * @param $roles
     * @param $user
     */
    private function flushRoles($roles, $user)
    {
        //Flush roles out,then add array of new ones
        $user->detachRoles($user->roles);
        $user->attachRoles($roles['assignees_roles']);
    }
    /**
     * @param $roles
     * @throws GeneralException
     */
    private function checkUserRolesCount($roles)
    {
        if(count($roles['assignees_roles'] )== 0){
            throw new GeneralException(trans('exceptions.backend.access.users.role_needed'));
        }
    }
    /**
     * @param $input
     * @param $user
     * @throws GeneralException
     */
    private function checkUserByEmail($input, $user)
    {
        //Figure out if the email is not the same
        if($user->email != $input['email']){
            //Check to see if email exists
            if(User::where('email','=',$input['email'])->first()){
                throw new GeneralException(trans('exceptions.backend.access.user.email_error'));
            }
        }
    }
    /**
     * Check to make sure at least one role is being applied or deactivate user
     *
     * @param $user
     * @param $roles
     * @throws UserNeedsRolesException
     */
    private function validateRoleAmount($user, $roles)
    {
        if(count($roles) == 0){
            //Deactivate user
            $user->status = 0;
            $user->save();

            $exception = new UserNeedsRolesException();
            $exception->setValidationErrors(trans('exceptions.backend.access.users.role_needed_create'));

            //Grab the user id in the controller
            $exception->setUserID($user->id);
            throw $exception;
        }
    }
    /**
     * @param $input
     * @return User
     */
    private function createUserStub($input)
    {
        $user                       = new User;
        $user->name                 = $input['name'];
        $user->email                = $input['email'];
        $user->password             = bcrypt($input['password']);
        $user->status               = isset($input['status']) ? 1 : 0;
        $user->confirmation_code    = md5(uniqid(mt_rand(), true));
        $user->confirmed            = isset($input['confirmed']) ? 1 : 0;
        return $user;
    }
}