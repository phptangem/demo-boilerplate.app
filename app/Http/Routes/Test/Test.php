<?php
Route::get('with','TestController@testWith');
Route::get('session','TestController@testSession');
Route::get('params','TestController@testParams')->name('test.testParams');