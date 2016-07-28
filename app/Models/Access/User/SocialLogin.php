<?php

namespace App\Models\Access\User;

use Illuminate\Database\Eloquent\Model;

class SocialLogin extends Model
{
    //
    /**
     *The database table used by the  model
     *
     * @var string
     */
    protected $table = 'social_logins';

    /**
     * The attribute that are not mass assignable
     *
     * @var array
     */
    protected $guarded = ['id'];
}
