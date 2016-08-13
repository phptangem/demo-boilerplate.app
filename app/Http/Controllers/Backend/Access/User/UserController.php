<?php

namespace App\Http\Controllers\Backend\Access\User;

use App\Repositories\Backend\Access\Permission\PermissionRepositoryContract;
use App\Repositories\Backend\Access\Role\RoleRepositoryContract;
use App\Repositories\Backend\Access\User\UserRepositoryContract;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Access\User\CreateUserRequest;
use App\Http\Requests\Backend\Access\User\StoreUserRequest;
use App\Http\Requests\Backend\Access\User\ChangeUserPasswordRequest;
use App\Http\Requests\Backend\Access\User\MarkUserRequest;
class UserController extends Controller
{
    /**
     * @var UserRepositoryContract
     */
    protected $users;

    /**
     * @var RoleRepositoryContract
     */
    protected $roles;

    /**
     * @var PermissionRepositoryContract
     */
    protected $permissions;

    public function __construct(
        UserRepositoryContract $users,
        RoleRepositoryContract $roles,
        PermissionRepositoryContract $permissions
    )
    {
        $this->users        = $users;
        $this->roles        =  $roles;
        $this->permissions  = $permissions;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('backend.access.index')
            ->withUsers($this->users->getUsersPaginated(config('access.users.default_per_page'),1));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(CreateUserRequest $request)
    {
        return view('backend.access.create')
            ->withRoles($this->roles->getAllRoles('sort','asc',true))
            ->withPermissions($this->permissions->getAllPermissions());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserRequest $request)
    {
        $this->users->create(
            $request->except('assignees_roles', 'permission_user'),
            $request->only('assignees_roles'),
            $request->only('permission_user')
        );

        return redirect()->route('admin.access.users.index')->withFlashSuccess(trans('alerts.backend.users.created'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = $this->users->findOrThrowException($id, true);
        return view('backend.access.edit')
            ->withUser($user)
            ->withUserRoles($user->roles->lists('id')->all())
            ->withRoles($this->roles->getAllRoles('sort', 'asc', true))
            ->withUserPermissions($user->permissions->lists('id')->all())
            ->withPermissions($this->permissions->getAllPermissions());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function deactivated()
    {
            return view('backend.access.deactivated')
                ->withUsers($this->users->getUsersPaginated(25,0));
    }

    public function deleted()
    {
        return view('backend.access.deleted')
            ->withUsers($this->users->getDeletedUsersPaginated(25));
    }
    public function changePassword($id, ChangeUserPasswordRequest $request)
    {
        return view('backend.access.change-password')
            ->withUser($this->users->findOrThrowException($id));
    }

    public function mark($id,$status, MarkUserRequest $request)
    {
        $this->users->mark($id, $status);

        return redirect()->back()->withFlashSuccess(trans('alerts.backend.users.updated'));
    }
    public function updatePassword($id)
    {

    }
}
