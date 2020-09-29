<?php

namespace Confrariaweb\Site\Providers;

use Illuminate\Support\ServiceProvider;

use Confrariaweb\Site\Repositories\Contracts\PageContract;
use Confrariaweb\Site\Repositories\Eloquent\PageEloquent;
use Confrariaweb\Site\Services\PageService;

class PageServiceProvider extends ServiceProvider
{
    
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    //protected $defer = true;
    
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__.'/../Routes/pages/web.php');
        $this->loadMigrationsFrom(__DIR__ . '/../Databases/Migrations/pages');
        $this->loadTranslationsFrom(__DIR__.'/../Translations/pages', 'page');
        $this->loadViewsFrom(__DIR__.'/../Views/pages', 'page');
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
       $this->app->bind(PageContract::class, PageEloquent::class);
        $this->app->singleton('PageService', function ($app) {
            return new PageService($app->make(PageContract::class));
        });
    }
    
    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    /*
    public function provides()
    {
        return [
            'PageService'
        ];
    }
    */
}
