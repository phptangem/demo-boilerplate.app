<?php

namespace App\Http\Controllers\Frontend\Auth;

use App\Http\Controllers\Controller;
use App\Repositories\Frontend\Access\User\UserRepositoryContract;
use App\Services\Access\Traits\AuthenticatesAndRegistersUsers;
use App\Services\Access\Traits\ConfirmUsers;

class AuthController extends Controller
{
    use AuthenticatesAndRegistersUsers, ConfirmUsers;

    public function __construct(UserRepositoryContract $user)
    {
        $this->user = $user;
    }
}
