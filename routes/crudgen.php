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


    
