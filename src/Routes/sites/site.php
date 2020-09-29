<?php

Route::namespace('Confrariaweb\Site\Controllers\Site')
    ->group(function () {
        Route::get('/', 'SiteController@home');
        /*
        Route::get('/home', 'SiteController@home')->name('home');

        Route::get('/imoveis', 'SiteController@propertyIndex')->name('properties');
        Route::get('/imovel/{slug}', 'SiteController@propertyShow')->name('property');
        Route::get('/paginas', 'SiteController@pageIndex')->name('pages');
        Route::get('/pagina/{slug}', 'SiteController@pageShow')->name('page');
        Route::get('/posts', 'SiteController@postIndex')->name('posts');
        Route::get('/post/{slug}', 'SiteController@postShow')->name('post');
        //Route::post('/lead', 'LeadController@store')->name('lead');
        */
    });