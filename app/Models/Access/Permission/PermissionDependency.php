<?php

namespace App\Models\Access\Permission;

use Illuminate\Database\Eloquent\Model;
use App\Models\Access\Permission\Traits\Relationship\PermissionDependencyRelationship;

class PermissionDependency extends Model
{
    use PermissionDependencyRelationship;

    /**
     * The database table used by the model
     *
     * @var string
     */
    protected $table;

    /**
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * PermissionDependency constructor.
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->table = config('access.permission_dependencies_table');
    }
}
