<?php

use Illuminate\Support\Facades\Route;
use LaravelEnso\Tasks\Http\Controllers\Tasks\ChecklistItems\Store;
use LaravelEnso\Tasks\Http\Controllers\Tasks\ChecklistItems\Update;
use LaravelEnso\Tasks\Http\Controllers\Tasks\ChecklistItems\Destroy;

Route::prefix('checklistItems')
    ->as('checklistItems.')
    ->group(function () {
		Route::post('', Store::class)->name('store');
		Route::patch('{checklistItem}', Update::class)->name('update');
		Route::delete('{checklistItem}', Destroy::class)->name('destroy');
    });
