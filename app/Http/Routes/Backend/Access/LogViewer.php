<?php
Route::group([
    'prefix'=>'log-viewer',
], function(){
    Route::get('/', [
        'as'=>'log-viewer::dashboard',
        'uses'=>'\Arcanedev\LogViewer\Http\Controllers\LogViewerController@index',
    ]);
    Route::group([
        'prefix'=>'logs'
    ],function(){
        Route::get('/',[
            'as'    => 'log::viewer::logs.list',
            'uses'  => '\Arcanedev\LogViewer\Http\Controllers\LogViewerController@listLogs'
        ]);
        Route::get('/{$data}' ,[

        ]);
    });
});