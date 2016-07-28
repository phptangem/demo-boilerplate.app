<?php

namespace App\Models\Access\Permission;

use Illuminate\Database\Eloquent\Model;
use  App\Models\Access\Permission\Traits\Attribute\PermissionGroupAttribute;
use  App\Models\Access\Permission\Traits\Relationship\PermissionGroupRelationship;

class PermissionGroup extends Model
{
    use PermissionGroupAttribute, PermissionGroupRelationship;

    /**
     * The database table used by the model
     *
     * @var
     */
    protected $table;

    /**
     * The attribute that are not mass assignable
     *
     * @var array
     */
    protected $guarded = ['id'];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->table = config('access.permission_group_table');
    }
}
