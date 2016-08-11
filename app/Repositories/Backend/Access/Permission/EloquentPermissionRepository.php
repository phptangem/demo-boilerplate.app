<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/7/25
 * Time: 9:10
 */
namespace App\Repositories\Backend\Access\Permission;

use App\Exceptions\GeneralException;
use App\Models\Access\Permission\Permission;
use App\Models\Access\Role\Role;
use App\Repositories\Backend\Access\Role\RoleRepositoryContract;
use App\Repositories\Backend\Access\Permission\Dependency\PermissionDependencyRepositoryContract;
use Mockery\CountValidator\Exception;

class EloquentPermissionRepository implements PermissionRepositoryContract
{
    /**
     * @var RoleRepositoryContract
     */
    protected $roles;

    /**
     * @var PermissionDependencyRepositoryContract
     */
    protected $dependencies;

    /**
     * EloquentPermissionRepository constructor.
     * @param RoleRepositoryContract $roles
     * @param PermissionDependencyRepositoryContract $dependencies
     */
    public function __construct(
        RoleRepositoryContract $roles,
        PermissionDependencyRepositoryContract $dependencies
    )
    {
        $this->roles = $roles;
        $this->dependencies = $dependencies;
    }

    /**
     * @param $id
     * @param bool $withRoles
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|null|static|static[]
     * @throws GeneralException
     */
    public function findOrThrowException($id, $withRoles = false)
    {
        if(! is_null(Permission::find($id))){
            if($withRoles){
                return Permission::with('roles')->find($id);
            }

            return Permission::find($id);
        }

        throw new GeneralException(trans('exceptions.backend.access.permissions.not_found'));
    }

    /**
     * @param $per_page
     * @param string $order_by
     * @param string $sort
     * @return mixed
     */
    public function getPermissionsPaginated($per_page, $order_by='display_name', $sort = 'asc')
    {
        return Permission::with('roles')->orderBy($order_by,$sort)->paginate($per_page);
    }

    /**
     * @param string $order_by
     * @param string $sort
     * @param bool $withRoles
     * @return mixed
     */
    public function getAllPermissions($order_by = 'display_name', $sort = 'asc',$withRoles=true)
    {
        if($withRoles){
            return Permission::with('roles', 'dependencies.permission')->orderBy($order_by,$sort)->get();
        }

        return Permission::with('dependencies.permission')->orderBy($order_by,$sort)->get();
    }

    /**
     * @return mixed
     */
    public function getUngroupedPermissions()
    {
        return Permission::whereNull('group_id')
            ->orderBy('display_name','asc')
            ->get();
    }

    /**
     * @param $input
     * @param $roles
     * @return bool
     * @throws GeneralException
     */
    public function create($input, $roles)
    {
        $permission                 = new Permission();
        $permission->name           = $input['name'];
        $permission->display_name   = $input['display_name'];
        $permission->system         = isset($input['system']) ? 1:0;
        $permission->group_id       = isset($input['group']) && strlen($input['group'])>0 ? (int)$input['group']:null;
        $permission->sort           = isset($input['sort']) ? (int)$input['sort'] :0;

        if($permission->save()){
                //For each role, load role, add perm to perms, flush perms, read perms
            if(count($roles['permission_roles']) > 0){
                foreach($roles['permission_roles'] as $role_id){
                    //Get the role, with permissions
                    $role = $this->roles->findOrThrowException($role_id, true);

                    //Get the roles permissions into an array
                    $role_permissions = $role->permissions->lists('id')->all();

                    if(count($role_permissions) >=1){
                        array_push($role_permissions, $permission->id);
                        array_walk($role_permissions, function(&$value){
                            $value = (int) $value;
                        });
                        $role->permissions()->sync($role_permissions);
                    }else{
                        $role->permissions()->sync([$permission->id]);
                    }
                }
            }

            //Add the dependencies of this permissions if any
            if(isset($input['dependencies']) && count($input['dependencies'])){
                    foreach($input['dependencies'] as $dependency_id){
                        $this->dependencies->created($permission->id, $dependency_id);
                    }
            }

            return true;
        }

        throw new GeneralException(trans('exceptions.backend.access.permissions.create_error'));
    }

    /**
     * @param $id
     * @param $input
     * @param $roles
     * @return bool
     * @throws GeneralException
     */
    public function update($id, $input, $roles)
    {
        $permission                 = $this->findOrThrowException($id);
        $permission->name           = $input['name'];
        $permission->display_name   = $input['display_name'];
        $permission->system         = isset($input['system']) ? 1 : 0;
        $permission->group_id       = isset($input['group']) && strlen($input['group']) > 0 ? (int)$input['group'] : null;
        $permission->sort           = isset($input['sort']) ? (int) $input['sort'] : 0 ;

        if($permission->save()){
            //Detach permission from every role, then add the permission to the selected roles
            $currentRoles = $this->roles->getAllRoles();
            foreach($currentRoles as $role){
                $role->detachPermission($permission);
            }

            if(count($roles['permission_roles']) > 0 ){
                foreach($roles['permission_roles'] as $role_id){
                    //Get the role, with permissions
                    $role = $this->roles->findOrThrowException($role_id, true);

                    //Get the roles permissions into an array

                    $role_permissions = $role->permissions->lists('id')->all();

                    if(count($role_permissions) >= 1){
                        array_push($role_permissions, $permission->id);
                        //For some reason the lists casts as a string,convert all to int
                        $role_permissions_temp = array();
                        foreach($role_permissions as $rp){
                            array_push($role_permissions,(int) $rp);
                        }
                        $role_permissions = $role_permissions_temp;

                        //Sync the permissions to the role
                        $role->permissions()->sync($role_permissions);
                    }else{
                        //Role has no permissions,add the 1
                        $role->permissions()->sync([$permission->id]);
                    }
                }
            }
            //Add the dependencies of the permissions if any
            if(isset($input['dependencies']) && count($input['dependencies'])){
                //Remove all current dependencies
                $this->dependencies->clear($permission->id);

                //Add the current checked dependencies
                foreach($input['dependencies'] as $dependency_id){
                    $this->dependencies->create($permission->id, $dependency_id);
                }
            }else
            //None checked, remove any if they were there prior
            {
                $this->dependencies->clear($permission->id);
            }

            return true;
        }
        throw  new GeneralException('exceptions.backend.access.permissions.update_error');
    }

    /**
     * @param $id
     * @return bool
     * @throws GeneralException
     * @throws \Exception
     */
    public function destroy($id)
    {
        $permission = $this->findOrThrowException($id);

        if($permission->system == 1){
            throw new GeneralException(trans('exceptions.backend.access.permissions.system_delete_error'));
        }

        //Remove  the permission from all associated roles
        $currentRoles = $permission->roles;
        foreach($currentRoles as $role){
            $role->detachPermission($permission);
        }

        //Remove the permission from all associated users
        $currentUsers = $permission->users;
        foreach($currentUsers as $user){
            $user->detachPermission($permission);
        }

        $permission->dependencies()->delete();

        if($permission->delete()){
            return true;
        }

        throw new GeneralException(trans('exceptions.backend.access.permissions.delete_error'));
    }
}