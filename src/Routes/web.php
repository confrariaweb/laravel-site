<?php

use Illuminate\Support\Facades\Route;

Route::prefix('dashboard')
    ->namespace('ConfrariaWeb\Site\Controllers\Backend')
    ->name('dashboard.')
    ->middleware(['web', 'auth'])
    ->group(function () {
        Route::prefix('sites')
            ->name('sites.')
            ->group(function () {
                Route::get('datatable', 'SiteController@datatables')->name('datatables');
            });
        Route::resource('sites', 'SiteController');
    });

Route::namespace('ConfrariaWeb\Site\Controllers\Frontend')
    ->middleware(['web'])
    ->group(function () {
        Route::get('/', 'SiteController@home');
        Route::get('/home', 'SiteController@home')->name('home');
    });