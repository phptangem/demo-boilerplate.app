<?php

namespace App\Http\Controllers\Backend\Access\Permission;

use App\Repositories\Backend\Access\Permission\Group\PermissionGroupRepositoryContract;
use App\Repositories\Backend\Access\Permission\PermissionRepositoryContract;
use App\Repositories\Backend\Access\Role\RoleRepositoryContract;
use App\Http\Requests\Backend\Access\Permission\CreatePermissionRequest;
use App\Http\Requests\Backend\Access\Permission\DeletePermissionRequest;
use App\Http\Requests\Backend\Access\Permission\StorePermissionRequest;
use App\Http\Requests\Backend\Access\Permission\UpdatePermissionRequest;
use App\Http\Requests\Backend\Access\Permission\EditPermissionRequest;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class PermissionController extends Controller
{
    protected  $roles;

    protected $permissions;

    protected $groups;

    public function __construct(
        RoleRepositoryContract $roles,
        PermissionRepositoryContract $permissions,
        PermissionGroupRepositoryContract $groups
    )
    {
        $this->roles        = $roles;
        $this->permissions  = $permissions;
        $this->groups       = $groups;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.access.roles.permissions.index')
            ->withPermissions($this->permissions->getPermissionsPaginated(50))
            ->withGroups($this->groups->getAllGroups());

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.access.roles.permissions.create')
            ->withGroups($this->groups->getAllGroups(true))
            ->withRoles($this->roles->getAllRoles())
            ->withPermissions($this->permissions->getAllPermissions());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
    public function edit($id, EditPermissionRequest $request)
    {
        $permission = $this->permissions->findOrThrowException($id);

        return view('backend.access.roles.permissions.edit')
            ->withPermission($permission)
            ->withRoles($this->roles->getAllRoles())
            ->withGroups($this->groups->getAllGroups())
            ->withPermissionRoles($permission->roles->lists('id')->all())
            ->withPermissions($this->permissions->getAllPermissions())
            ->withPermissionDependencies($permission->dependencies->lists('dependency_id')->all());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePermissionRequest $request, $id)
    {

        $this->permissions->update($id,$request->except('permission_roles'),$request->only('permission_roles'));
        return redirect()->route('admin.access.roles.permissions.index')->withFlashSuccess(trans('alerts.backend.permissions.updated'));
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
}
