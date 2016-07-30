<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/7/22
 * Time: 11:17
 */
namespace App\Services\Access\Traits;

use Illuminate\Http\Request;
use App\Exceptions\GeneralException;
use App\Events\Frontend\Auth\UserLoggedIn;
use App\Events\Frontend\Auth\UserLoggedOut;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use App\Http\Requests\Frontend\Auth\LoginRequest;
trait AuthenticatesUsers
{
    use RedirectsUsers;

    /**
     * @return mixed
     */
    public function showLoginForm()
    {
        return view('frontend.auth.login');
//            ->withSocialiteLinks($this->getSolialLinks());
    }

    /**
     * @param LoginRequest $request
     * @return $this|\Illuminate\Http\RedirectResponse
     * @throws GeneralException
     */
    public function login(LoginRequest $request)
    {
        $throttles = in_array(
            ThrottlesLogins::class, class_uses_recursive(get_class($this))
        );
        if ($throttles && $this->hasTooManyLoginAttampts($request)) {
            return $this->sendLockoutResponse($request);
        }


        if (auth()->attempt($request->only($this->loginUsername(), 'password'), $request->has('remember'))) {
            return $this->handleUserWasAuthenticated($request, $throttles);
        }
        if ($throttles) {
            $this->incrementLoginAttampts($request);
        }

        return redirect()->back()
            ->withInput($request->only($this->loginUsername(), 'remember'))
            ->withErrors([
                $this->loginUsername() => trans('auth.failed'),
            ]);
    }

    public function logout()
    {
        /**
         * Remove the socialite variable if exists
         */
        if(app('session')->has(config('access.socialite_session_name'))){
            app('session')->forget(config('access.socialite_session_name'));
        }

        event(new UserLoggedout(access()->user()));
        auth()->logout();
        return redirect(property_exists($this,'redirectAfterLogout') ? $this->redirectAfterLogout:'/');
    }
    /**
     * The is here so that we can use the default Laravel ThrottlesLogins Trait
     *
     * @return string
     */
    public function loginUsername()
    {
        return 'email';
    }
    /**
     * @param Request $request
     * @param $throttles
     * @return \Illuminate\Http\RedirectResponse
     * @throws GeneralException
     */
    protected function handleUserWasAuthenticated(Request $request, $throttles)
    {
        if($throttles){
            $this->clearLoginAttampts($request);
        }
        /**
         * Check to see if the users account is confirmed and active
         */
        if(! access()->user()->isConfirmed()){
            $id = access()->user()->id;
            auth()->logout();
            throw new GeneralException(trans('exceptions.frontend.auth.confirmation.resend', ['user_id'=>$id]));
        }elseif(! access()->user()->isActive()){
            auth()->logout();
            throw new GeneralException(trans('exceptions.frontend.auth.deactivated'));
        }

        event(new UserLoggedIn(access()->user()));
        return redirect()->intended($this->redirectPath());
    }
}