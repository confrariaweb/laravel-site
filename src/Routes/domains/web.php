<?php

Route::prefix('admin/site')
    ->namespace('Confrariaweb\Site\Controllers')
    ->name('admin.sites.')
    ->middleware(['web', 'auth'])
    ->group(function () {
        Route::resource('domains', DomainController::class);
    });
