<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/7/25
 * Time: 9:40
 */
namespace App\Repositories\Backend\Access\Permission\Dependency;

interface PermissionDependencyRepositoryContract
{
    /**
     * @param $permission_id
     * @param $dependency_id
     * @return mixed
     */
    public function create($permission_id, $dependency_id);

    /**
     * @param $permission_id
     * @return mixed
     */
    public function clear($permission_id);
}