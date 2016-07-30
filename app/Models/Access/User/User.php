<?php

namespace App\Models\Access\User;

use Illuminate\Database\Eloquent\Model;
use App\Models\Access\User\Traits\UserAccess;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\Access\User\Traits\Relationship\UserRelationship;
use App\Models\Access\User\Traits\Attribute\UserAttribute;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use SoftDeletes, UserAccess,  UserAttribute, UserRelationship;

    /**
     *The attributes that are not mass assignable
     *
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * The attributes that should be hidden for arrays
     *
     * @var array
     */
    protected $hidden = ['password','remember_token'];

    /**
     * @var array
     */
    protected $dates = ['deleted_at'];
}
