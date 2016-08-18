<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/7/27
 * Time: 9:19
 */
namespace App\Repositories\Backend\Access\Permission\Group;

use App\Exceptions\GeneralException;
use App\Models\Access\Permission\PermissionGroup;

class EloquentPermissionGroupRepository implements PermissionGroupRepositoryContract
{
    /**
     * @param $id
     * @return mixed
     */
    public function find($id)
    {
        return PermissionGroup::findOrFail($id);
    }

    /**
     * @param int $limit
     * @return mixed
     */
    public function getGroupsPaginated($limit = 50)
    {
        return PermissionGroup::with('children', 'permissions')
            ->whereNull('parent_id')
            ->orderBy('sort', 'asc')
            ->paginate($limit);
    }

    /**
     * @param bool $withChildren
     * @return mixed
     */
    public function getAllGroups($withChildren = false)
    {
        if($withChildren){
            return PermissionGroup::orderBy('sort', 'asc')->get();
        }

        return PermissionGroup::with('children', 'permissions')
            ->whereNull('parent_id')
            ->orderBy('sort', 'asc')
            ->get();
    }

    /**
     * @param $input
     * @return bool
     */
    public function store($input)
    {
        $permissionGroup            = new PermissionGroup();
//        $permissionGroup->parent_id = null;
//        $permissionGroup->sort      = $input['sort'];
        $permissionGroup->name      = $input['name'];

        return $permissionGroup->save();
    }

    /**
     * @param $id
     * @param $input
     * @return mixed
     * @throws GeneralException
     */
    public function update($id, $input)
    {
        $permissionGroup = $this->find($id);

        if($permissionGroup->name != $input['name']){
            if(PermissionGroup::where('name', $input['name'])->count()){
                throw new GeneralException(trans('exceptions.backend.access.permissions.groups.name_taken'));
            }
        }

        return $permissionGroup->update($input);
    }

    /**
     * @param $id
     * @return mixed
     * @throws GeneralException
     */
    public function destroy($id)
    {
        $permissionGroup = $this->find($id);

        if($permissionGroup->children->count()){
            throw new GeneralException(trans('exceptions.backend.access.permissions.groups.has_children'));
        }

        if($permissionGroup->permissions->count()){
            throw new GeneralException(trans('exceptions.backend.access.permissions.groups.associated_permissions'));
        }

        return $permissionGroup->delete();
    }

    /**
     * @param $hierarchy
     * @return bool
     */
    public function updateSort($hierarchy)
    {
        $parent_sort = 1;
        $child_sort = 1;
        foreach($hierarchy as $group) {
            $this->find((int)$group['id'])->update([
                'parent_id'=>null,
                'sort'  => $parent_sort,
            ]);

            if(isset($group['children']) && count($group['children'])){
                foreach($group['children'] as $child){
                    $this->find((int)$child['id'])->update([
                        '$parent_id' => (int) $group['id'],
                        'sort'      => $child_sort,
                    ]);

                    $child_sort++;
                }
            }

            $parent_sort++;
        }

        return true;
    }
}