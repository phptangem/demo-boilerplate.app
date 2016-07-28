<?php
Route::group(['middleware'=>'web'],function(){
    /**
     * Frontend Routes
     * Namespace indicate folder structure
     */
    Route::group(['namespace'=>'Frontend'], function(){
        require(__DIR__.'/Routes/Frontend/Access.php');
        require(__DIR__.'/Routes/Frontend/Frontend.php');
    });

    /**
     * Switch between the included languages
     */

    Route::group(['namespace'=>'Language'], function(){
        require(__DIR__.'/Routes/Language/Language.php');
    });
});

/**
 * Backend Routes
 *Namespace indicate folder structure
 * Admin middleware groups web , auth and routesNeedsPermission
 */
Route::group(['namespace'=>'Backend', 'prefix'=>'admin', 'middleware'=>'admin'], function(){
    require(__DIR__.'/Routes/Backend/Access/Access.php');
});

/**
 * Test Routes
 *
 * Namespace indicate folder structure
 */
Route::group(['namespace'=>'Test','prefix'=>'test'], function(){
    require(__DIR__.'/Routes/Test/Test.php');
});