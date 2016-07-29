<?php
namespace App\Services\Access\Traits;

trait ConfirmUsers
{
    /**
     * Confirms the user account by their token
     *
     * @param $token
     * @return mixed
     */
    public function confirmAccount($token)
    {
        $this->user->confirmAccount($token);

        return redirect()->route('auth.login')->withFlashSuccess(trans('exceptions.frontend.auth.confirmation.success'));
    }

    public function resendConfirmationEmail($user_id)
    {
        $this->user->resendConfirmationEmail($user_id);
        return redirect()->route('auth.login')->withFlashSuccess(trans('exceptions.frontend.auth.confirmation.resend', ['user_id'=>$user_id]));
    }
}