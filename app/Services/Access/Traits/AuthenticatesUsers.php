<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/7/22
 * Time: 11:17
 */
namespace App\Services\Access\Traits;

use Illuminate\Foundation\Auth\RedirectsUsers;

trait AuthenticatesUsers
{
    use RedirectsUsers;
    /**
     * @return mixed
     */
    public function showLoginForm()
    {
        return view('frontend.auth.login')
            ->withSocialiteLinks($this->getSolialLinks());
    }
}