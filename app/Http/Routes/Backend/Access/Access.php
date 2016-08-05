<?php
Route::group([
    'prefix'=>'access',
    'namespace'=>'Access',
    'middleware'=>'access.routeNeedsPermission:view-access-management',
],function(){
    /**
     * User Management
     */
    Route::group(['namespace'=>'User'], function(){

        Route::resource('users', 'UserController',['except'=>['show']]);

        Route::get('account/confirm/resend/{user_id}', 'UserController@resendConfirmationEmail')->name('admin.account.confirm.resend');
        Route::get('users/deactivated', 'UserController@deactivated')->name('admin.access.users.deactivated');
        Route::get('users/deleted','UserController@deleted')->name('admin.access.users.deleted');
        /**
         * Specific User
         */
        Route::group(['prefix'=>'user/{id}','where'=>['id'=>'[0-9]+']], function(){
            Route::get('mark/{status}', 'UserController@mark')->name('admin.access.user.mark')->where('status','[0,1]');
        });
    });

    /**
     * Role Management
     */
    Route::group(['namespace'=>'Role'], function(){
        Route::resource('roles','RoleController', ['except'=>['show']]);
    });

    /**
     * Permission Management
     */
    Route::group(['prefix'=>'roles', 'namespace'=>'Permission'], function(){
        Route::resource('permission-group', 'PermissionGroupController', ['except'=>['index','show']]);
        Route::resource('permissions', 'PermissionController', ['except'=>['show']]);

        Route::group(['prefix'=>'groups'] ,function(){
            Route::post('update-sort', 'PermissionGroupController@updateSort')->name('admin.access.roles.groups.update-sort');
        });
    });
});