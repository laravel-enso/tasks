<?php

use Illuminate\Support\Facades\Route;
use LaravelEnso\Tasks\Http\Controllers\ChecklistItems\Create;
use LaravelEnso\Tasks\Http\Controllers\ChecklistItems\Destroy;
use LaravelEnso\Tasks\Http\Controllers\ChecklistItems\Edit;
use LaravelEnso\Tasks\Http\Controllers\ChecklistItems\Options;
use LaravelEnso\Tasks\Http\Controllers\ChecklistItems\Store;
use LaravelEnso\Tasks\Http\Controllers\ChecklistItems\Update;

Route::prefix('checklistItems')
    ->as('checklistItems.')
    ->group(function () {
        Route::get('create', Create::class)->name('create');
        Route::post('', Store::class)->name('store');
        Route::get('{checklistItem}/edit', Edit::class)->name('edit');
        Route::patch('{checklistItem}', Update::class)->name('update');
        Route::delete('{checklistItem}', Destroy::class)->name('destroy');
        Route::get('options', Options::class)->name('options');
    });
