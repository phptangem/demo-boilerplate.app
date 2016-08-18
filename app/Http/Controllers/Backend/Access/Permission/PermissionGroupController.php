<?php

namespace App\Http\Controllers\Backend\Access\Permission;

use App\Http\Requests\Backend\Access\Permission\Group\EditPermissionGroupRequest;
use App\Http\Requests\Backend\Access\Permission\Group\SortPermissionGroupRequest;
use App\Http\Requests\Backend\Access\Permission\Group\StorePermissionGroupRequest;
use App\Http\Requests\Backend\Access\Permission\Group\UpdatePermissionGroupRequest;
use App\Http\Requests\Backend\Access\Permission\Group\CreatePermissionGroupRequest;
use App\Http\Requests\Backend\Access\Permission\Group\DeletePermissionGroupRequest;
use App\Repositories\Backend\Access\Permission\Group\PermissionGroupRepositoryContract;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class PermissionGroupController extends Controller
{
    protected $groups;

    public function __construct(PermissionGroupRepositoryContract $groups)
    {
        $this->groups = $groups;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(CreatePermissionGroupRequest $request)
    {
        return view('backend.access.roles.permissions.groups.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePermissionGroupRequest $request)
    {
        $this->groups->store($request->all());

        return redirect()->route('admin.access.roles.permissions.index')->withFlashSuccess(trans('alerts.backend.permissions.groups.created'));
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
    public function edit($id, EditPermissionGroupRequest $request)
    {
        return view('backend.access.roles.permissions.groups.edit')
            ->withGroup($this->groups->find($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id, UpdatePermissionGroupRequest $request)
    {
        $this->groups->update($id,$request->all());
        return redirect()->route('admin.access.roles.permissions.index')->withFlashSuccess(trans('alerts.backend.permissions.groups.created'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, DeletePermissionGroupRequest $request)
    {
        $this->groups->destroy($id);

        return redirect()->route('admin.access.roles.permissions.index')->withFlashSuccess(trans('alerts.backend.permissions.groups.deleted'));
    }

    public function updateSort(StorePermissionGroupRequest $request)
    {
        
    }
}
