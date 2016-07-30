<?php
/**
 * Frontend access controller
 */
Route::group(['namespace'=>'Auth'],function(){

    /**
     * These routes require the user to be logged in
     */
    Route::group(['middleware'=>'auth'], function(){
        Route::get('logout', 'AuthController@logout')->name('auth.logout');
        Route::get('password/change', 'PasswordController@showChangePasswordForm')->name('auth.password.change');
        Route::post('password/update', 'PasswordController@changePassword')->name('auth.password.update');
    });

    /**
     *These routes require the  user NOT be logged in
     */
    Route::group(['middleware'=>'guest'], function(){

        //Authentication Routes
        Route::get('login', 'AuthController@showLoginForm')
            ->name('auth.login');
        Route::post('login', 'AuthController@login');
        //Registration Routes
        Route::get('register', 'AuthController@showRegistrationForm')
            ->name('auth.register');
        Route::post('register', 'AuthController@register');

        //Confirm Account Routes
        Route::get('account/confirm/{token}', 'AuthController@confirmAccount')
            ->name('account.confirm');
        Route::get('account/confirm/resend/{user_id}', 'AuthController@resendConfirmationEmail')
            ->name('account.confirm.resend');
    });
});