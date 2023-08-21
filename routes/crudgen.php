<?php

use App\Http\Controllers\CrudGenerator\CrudGenController;


Route::group(
    ['prefix' => 'dev/crudgen', 'as' => 'crudgen.', 'controller' => CrudGenController::class], function () {
        Route::get('/', 'index')->name('index');
        Route::get('/new', 'new')->name('new');
        Route::post('/generate', 'generate')->name('generate');
        Route::post('/bulk-import/generate', 'bulkImportGenerate')->name('bulk-import.generate');
        Route::get('/get-col', 'getColumns')->name('get-col');
    }
);


    
    Route::group(['middleware' => ['can:view_votes'],'namespace' => 'App\Http\Controllers\Admin', 'prefix' => 'admin/votes','as' =>'admin.votes.'], function () {
        Route::get('', ['uses' => 'VoteController@index', 'as' => 'index']);
        Route::any('/print', ['uses' => 'VoteController@print', 'as' => 'print']);
        Route::get('create', ['uses' => 'VoteController@create', 'as' => 'create']);
        Route::post('store', ['uses' => 'VoteController@store', 'as' => 'store']);
        Route::get('edit/{vote}', ['uses' => 'VoteController@edit', 'as' => 'edit']);
        Route::post('update/{vote}', ['uses' => 'VoteController@update', 'as' => 'update']);
        Route::post('more-action', ['uses' => 'VoteController@moreAction', 'as' => 'more-action']);
        Route::get('delete/{vote}', ['uses' => 'VoteController@destroy', 'as' => 'destroy']);
        Route::get('restore/{id}', ['uses' => 'VoteController@restore', 'as' => 'restore']);  
        Route::get('/{vote}', ['uses' => 'VoteController@show', 'as' => 'show']);
    }); 
    
    

