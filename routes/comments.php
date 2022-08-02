<?php

use LaravelEnso\Tasks\Http\Controllers\Comments\Destroy;
use LaravelEnso\Tasks\Http\Controllers\Comments\Index;
use LaravelEnso\Tasks\Http\Controllers\Comments\Store;
use LaravelEnso\Tasks\Http\Controllers\Comments\Update;
use Illuminate\Support\Facades\Route;

Route::prefix('comments')
    ->as('comments.')
    ->group(function () {
        Route::get('', Index::class)->name('index');
        Route::post('', Store::class)->name('store');
        Route::patch('{comment}', Update::class)->name('update');
        Route::delete('{comment}', Destroy::class)->name('destroy');

    });
