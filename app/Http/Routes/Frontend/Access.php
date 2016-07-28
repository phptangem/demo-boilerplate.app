<?php
/**
 * Frontend access controller
 */
Route::group(['namespace'=>'Auth'],function(){
    Route::group(['middleware'=>'guest'], function(){
        //Registration Routes
        Route::get('register', 'AuthController@showRegistrationForm')
            ->name('auth.register');
        Route::post('register', 'AuthController@register');
    });
});