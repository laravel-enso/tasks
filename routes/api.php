<?php

use Illuminate\Support\Facades\Route;

Route::middleware(['api', 'auth', 'core'])
    ->namespace('LaravelEnso\Tasks\Http\Controllers\Tasks')
    ->prefix('api/tasks')
    ->as('tasks.')
    ->group(function () {
        Route::get('create', 'Create')->name('create');
        Route::post('', 'Store')->name('store');
        Route::get('{task}/edit', 'Edit')->name('edit');

        Route::patch('{task}', 'Update')->name('update');

        Route::delete('{task}', 'Destroy')->name('destroy');

        Route::get('initTable', 'InitTable')->name('initTable');
        Route::get('tableData', 'TableData')->name('tableData');
        Route::get('exportExcel', 'ExportExcel')->name('exportExcel');

        Route::get('count', 'Count')->name('count');
        Route::get('', 'Index')->name('index');
    });
