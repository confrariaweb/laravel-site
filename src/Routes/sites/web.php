<?php

if (!app()->runningInConsole()) {
    Route::prefix('admin')
        ->namespace('Confrariaweb\Site\Controllers')
        ->name('admin.')
        ->middleware(['web', 'auth'])
        ->group(function () {
            Route::resource('sites', SiteController::class);
        });
}