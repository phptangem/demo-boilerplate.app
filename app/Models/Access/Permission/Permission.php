<?php

namespace App\Models\Access\Permission;

use Illuminate\Database\Eloquent\Model;
use  App\Models\Access\Permission\Traits\Attribute\PermissionAttribute;
use  App\Models\Access\Permission\Traits\Relationship\PermissionRelationship;

class Permission extends Model
{
    use PermissionAttribute, PermissionRelationship;

    /**
     * Database table used by the model
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

    public function __construct(array $attribute = [])
    {
        parent::__construct($attribute);
        $this->table = config('access.permissions_table');
    }
}
