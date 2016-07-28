<?php
Route::group([
    'prefix'=>'access',
    'namespace'=>'Access',
    'middleware'=>'access.routeNeedPermission:view-access-management',
],function(){
    /**
     * User Management
     */
    Route::group(['namespace'=>'User'], function(){

        Route::get('account/confirm/resend/{user_id}', 'UserController@resendConfirmationEmail')->name('admin.account.confirm.resend');
        Route::get('users/deleted','UserController@deleted')->name('admin.access.users.deleted');
        /**
         * Specific User
         */
        Route::group(['prefix'=>'user/{id}','where'=>['id'=>'[0-9]+']], function(){
            Route::get('mark/{status}', 'UserController@mark')->name('admin.access.user.mark')->where('status','[0,1]');
        });
    });
});