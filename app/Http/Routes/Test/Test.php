<?php
Route::get('with','TestController@testWith');
Route::get('session','TestController@testSession');
Route::get('log','TestController@testLog');
Route::get('params','TestController@testParams')->name('test.testParams');