<?php
/**
 * Frontend access controller
 */
Route::group(['namespace'=>'Auth'],function(){
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