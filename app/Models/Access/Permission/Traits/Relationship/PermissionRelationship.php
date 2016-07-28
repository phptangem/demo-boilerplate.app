<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/7/27
 * Time: 14:08
 */

namespace App\Models\Access\Permission\Traits\Relationship;

trait PermissionRelationship
{
    /**
     * @return mixed
     */
    public function roles()
    {
        return $this->belongsToMany(config('access.role'), config('access.permission_role_table'),'permission_id', 'role_id');
    }

    /**
     * @return mixed
     */
    public function group()
    {
        return $this->belongsTo(cofig('access.group'),'group_id');
    }

    /**
     * @return mixed
     */
    public function users()
    {
        return $this->belongsToMany(config('auth.providers.users.model'), config('access.permission_user_table'), 'permission_id', 'user_id');
    }

    /**
     * @return mixed
     */
    public function dependencies()
    {
        return $this->hasMany(config('access.dependency'), 'permission_id', 'id');
    }
}