<?php

namespace App\Http\Controllers\Frontend\Auth;

use App\Http\Controllers\Controller;
use App\Repositories\Frontend\Access\User\UserRepositoryContract;
use App\Services\Access\Traits\AuthenticatesAndRegistersUsers;

class AuthController extends Controller
{
    use AuthenticatesAndRegistersUsers;

    public function __construct(UserRepositoryContract $user)
    {
        $this->user = $user;
    }
}
