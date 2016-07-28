<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/7/27
 * Time: 14:10
 */
namespace App\Models\Access\Permission\Traits\Relationship;

trait PermissionGroupRelationship
{
    /**
     * @return mixed
     */
    public function children()
    {
        return $this->hasMany(config('access.group'), 'parent_id', 'id')->orderBy('sort', 'asc');
    }

    /*
     *
     */
    public function permissions()
    {
        return $this->hasMany(config('access.permission'), 'group_id')->orderBy('sort', 'asc');
    }
}