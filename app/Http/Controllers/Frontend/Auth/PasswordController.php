<?php

namespace App\Http\Controllers\Frontend\Auth;

use App\Repositories\Frontend\Access\User\UserRepositoryContract;
use App\Services\Access\Traits\ChangePasswords;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class PasswordController extends Controller
{
    use ChangePasswords;

    /**
     * Where to redirect the user after the user has been successfully reset
     *
     * @var string
     */
    protected $redirectTo = '/dashboard';

    public function __construct(UserRepositoryContract $user)
    {
        $this->user = $user;
    }
}
