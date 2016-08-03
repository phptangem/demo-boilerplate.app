<?php
Route::group([
    'prefix'=>'log-viewer',
], function(){
    Route::get('/', [
        'as'=>'log-viewer::dashboard',
        'uses'=>'\Arcanedev\LogViewer\Http\Controllers\LogViewerController@index',
    ]);
});