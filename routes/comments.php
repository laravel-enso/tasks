<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Tasks\Comments\Destroy;
use App\Http\Controllers\Tasks\Comments\Index;
use App\Http\Controllers\Tasks\Comments\Store;
use App\Http\Controllers\Tasks\Comments\Update;

Route::prefix('comments')
    ->as('comments.')
    ->group(function () {
        Route::get('', Index::class)->name('index');
        Route::post('', Store::class)->name('store');
        Route::patch('{comment}', Update::class)->name('update');
        Route::delete('{comment}', Destroy::class)->name('destroy');
    });
