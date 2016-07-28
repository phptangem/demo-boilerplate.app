<?php
namespace App\Models\Access\Role\Traits;
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/7/23
 * Time: 16:47
 */
trait RoleAccess
{
    /**
     * Save the inputted permissions
     *
     * @param $inputPermissions
     */
    public function savePermissions($inputPermissions)
    {
        if(!empty($inputPermissions)){
            $this->permissions()->sync($inputPermissions);
        }else{
            $this->permissions()->detach();
        }
    }

    /**
     * Attach permission to current role
     *
     * @param $permission
     */
    public function attachPermission($permission)
    {
        if(is_object($permission)){
            $permission = $permission->getKey();
        }
        if(is_array($permission)){
            $permission = $permission['id'];
        }
        $this->permissions()->attach($permission);
    }

    /**
     * Detach permission from current role.
     *
     * @param $permission
     */
    public function detachPermission($permission)
    {
        if(is_object($permission)){
            $permission = $permission->getKey();
        }
        if(is_array($permission)){
            $permission = $permission['id'];
        }
        $this->permissions()->detach($permission);
    }

    /**
     * Attach multiple permissions to current role
     *
     * @param $permissions
     */
    public function attachPermissions($permissions)
    {
        foreach($permissions as $permission){
            $this->attachPermission($permission);
        }
    }

    /**
     * Detach multiple permissions from current role
     *
     * @param $permissions
     */
    public function detachPermissions($permissions)
    {
        foreach($permissions as $permission){
            $this->detachPermission($permission);
        }
    }
}