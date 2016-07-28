<?php

namespace App\Repositories\Frontend\Access\User;

use App\Exceptions\GeneralException;
use App\Models\Access\User\User;
use App\Models\Access\User\SocialLogin;
use App\Repositories\Backend\Access\Role\RoleRepositoryContract;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;


class EloquentUserRepository implements UserRepositoryContract
{
    /**
     * @var RoleRepositoryContract
     */
    protected $role;

    /**
     * EloquentUserRepository constructor.
     * @param RoleRepositoryContract $role
     */
    public function __construct(RoleRepositoryContract $role)
    {
        $this->role  = $role;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function find($id)
    {
        return User::findOrFail($id);
    }

    /**
     * @param $email
     * @return bool
     */
    public function findByEmail($email)
    {
        $user = User::where('email', $email)->first();

        if($user instanceof User){
            return $user;
        }
        return false;
    }

    /**
     * @param $token
     * @return mixed
     * @throws GeneralException
     */
    public function findByToken($token)
    {
        $user = User::where('confirmation_token', $token)->first();

        if(! $user instanceof User){
            throw new GeneralException(trans('exceptions.frontend.auth.confirmation.not_found'));
        }

        return $user;
    }

    /**
     * @param $data
     * @param bool $provider
     * @return static
     */
    public function create($data, $provider = false)
    {
        if($provider){
            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => null,
                'confirmation_code' => md5(uniqid(mt_rand(), true)),
                'confirmed' => 1,
                'status'=>1,
            ]);
        }else{
            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => bcrypt($data['password']),
                'confirmation_code' => md5(uniqid(mt_rand(), true)),
                'confirmed' => config('access.users.confirm_email') ? 0 : 1,
                'status'=>1,
            ]);
        }

        /**
         * Add the default site role to the new user
         */
        $user->attachRole($this->role->getDefaultUserRole());

        /**
         * If users have to confirm their email and this is not a social account
         * send the confirmation email
         *
         * If this is social account  they are confirmed through the social provider by default
         */
        if(config('access.users.confirm_email') && $provider === false){
            $this->sendConfirmationEmail($user);
        }

        /**
         * Return the user object
         */
        return $user;
    }

    /**
     * @param $data
     * @param $provider
     * @return EloquentUserRepository|bool
     */
    public function findOrCreateSocial($data, $provider)
    {
        /**
         * Check if their is a user with this email first
         */
        $user = $this->findByEmail($data->email);

        /**
         * If the user does not exist, create them
         * The true flag indicate that it is a social account
         * Which trigger the script to use some default values in create method
         */
        if(! $user){
            $user = $this->create([
                'name' => $data->name,
                'email'=>$data->email ? :"{$data->id}@{$provider}.com"
            ], true);
        }

        /**
         * See if the has logged in with social account before
         */
        if(! $user->hasProvider($provider)){
            /**
             * Gather the provider data for saving and associate it with the user
             */
            $user->provider()->save(new SocialLogin([
                'provider' => $provider,
                'provider_id' => $data->id,
                'token' => $data->token,
                'avatar' => $data->avatar,
            ]));
        }else{
            /**
             * Update the user information,token and avatar can be updated
             */
            $user->providers()->update([
                'token'=>$data->token,
                'avatar'=>$data->avatar,
            ]);
        }

        /**
         * Return the user object
         */
        return $user;
    }

    /**
     * @param $token
     * @return mixed
     * @throws GeneralException
     */
    public function confirmAccount($token)
    {
        $user =$this->findByToken($token);

        if($user->isConfirmed == 1){
            throw new GeneralException(trans('exceptions.frontend.auth.confirmation.already_confirmed'));
        }

        if($user->confirmation_code == $token){
            $user->confirmed = 1;
            return $user->save();
        }

        throw new GeneralException(trans('exceptions.frontend.auth.confirmation.mismatch'));
    }

    /**
     * @param $user
     * @return mixed
     */
    public function sendConfirmationEmail($user)
    {
        if(! $user instanceof User){
            $user = $this->find($user);
        }

        return Mail::send('frontend.auth.email.confirm',['token' => $user->confirmation_code], function($message) use($user){
            $message->to($user->email, $user->name)->subject(app_name().':'.trans('exceptions.frontend.auth.confirmation.confirm'));
        });
    }

    /**
     * @param $user_id
     * @return mixed
     */
    public function resendConfirmationEmail($user_id)
    {
        return $this->sendConfirmationEmail($this->find($user_id));
    }

    /**
     * @param $id
     * @param $input
     * @return mixed
     * @throws GeneralException
     */
    public function updateProfile($id, $input)
    {
        $user = $this->find($id);
        $user->name = $input['name'];

        if($user->canChangeEmail()){
            //Address is not current address
            if($user->email != $input['email']){
                //Emails have to be unique
                if($this->findByEmail($input['email'])){
                    throw new GeneralException(trans('exceptions.frontend.auth.email_taken'));
                }

                $user->email = $input['email'];
            }
        }

        return $user->save();
    }

    /**
     * @param $input
     * @return mixed
     * @throws GeneralException
     */
    public function changePassword($input)
    {
        $user = $this->find(access()->id());

        if(Hash::check($input['old_password'], $user->password)){
            $user->password = bcrypt($input['password']);
            return $user->save();
        }

        throw new GeneralException(trans('exceptions.frontend.auth.password.change_mismatch'));
    }
}