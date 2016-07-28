<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/7/22
 * Time: 11:17
 */
namespace App\Services\Access\Traits;

trait AuthenticatesUsers
{
    /**
     * @return mixed
     */
    public function showLoginForm()
    {
        return view('frontend.auth.login')
            ->withSocialiteLinks($this->getSolialLinks());
    }
}