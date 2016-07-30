<?php
namespace App\Services\Access\Traits;
use App\Http\Requests\Frontend\User\ChangePasswordRequest;
trait ChangePasswords
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showChangePasswordForm()
    {
        return view('frontend.auth.passwords.change');
    }

    public function changePassword(ChangePasswordRequest $request)
    {
        $this->user->changePassword($request->all());
        return redirect()->route('frontend.user.dashboard')->withSuccess(trans('strings.frontend.user.password_updated'));
    }
}