<?php

namespace Confrariaweb\Site\Providers;

use Illuminate\Support\ServiceProvider;

use Confrariaweb\Site\Repositories\Contracts\PageTypeContract;
use Confrariaweb\Site\Repositories\Eloquent\PageTypeEloquent;
use Confrariaweb\Site\Services\PageTypeService;

class PageTypeServiceProvider extends ServiceProvider
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
        $this->loadRoutesFrom(__DIR__.'/../Routes/page_types/web.php');
        $this->loadMigrationsFrom(__DIR__ . '/../Databases/Migrations/page_types');
        //$this->loadTranslationsFrom(__DIR__.'/../Translations/page_types', 'page_type');
        $this->loadViewsFrom(__DIR__.'/../Views/page-types', 'pageType');
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
       $this->app->bind(PageTypeContract::class, PageTypeEloquent::class);
        $this->app->singleton('SitePageTypeService', function ($app) {
            return new PageTypeService($app->make(PageTypeContract::class));
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
            'PageTypeService'
        ];
    }
    */
}
