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
                /*Route::prefix('menus')
                    ->name('menus.')
                    ->group(function () {
                        Route::get('datatable', 'SiteMenuController@datatables')->name('datatables');
                    });
                Route::resource('menus', 'SiteMenuController');*/
                /*Route::get('{id}/edit/{page}', 'SiteController@edit')->name('edit.page');*/
            });
        Route::resource('sites', 'SiteController');
    });

Route::namespace('ConfrariaWeb\Site\Controllers\Frontend')
    ->middleware(['web'])
    ->group(function () {
        Route::get('/', 'SiteController@index');
        Route::get('/index', 'SiteController@index')->name('index');
        //Route::get('/home', 'SiteController@index')->name('home');
        Route::get('/{page}/{slug}', 'SiteController@page')->name('page');
    });