<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/7/26
 * Time: 10:37
 */
namespace App\Models\Access\Permission\Traits\Relationship;

trait PermissionDependencyRelationship
{
    /**
     * @return mixed
     */
    public function permission()
    {
        return $this->hasOne(config('access.permission'), 'id', 'dependency_id');
    }
}