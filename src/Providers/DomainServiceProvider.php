<?php

namespace Confrariaweb\Site\Providers;

use Illuminate\Support\ServiceProvider;

use Confrariaweb\Site\Repositories\Contracts\DomainContract;
use Confrariaweb\Site\Repositories\Eloquent\DomainEloquent;
use Confrariaweb\Site\Services\DomainService;

class DomainServiceProvider extends ServiceProvider
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
        $this->loadRoutesFrom(__DIR__.'/../Routes/domains/web.php');
        $this->loadMigrationsFrom(__DIR__ . '/../Databases/Migrations/domains');
        $this->loadTranslationsFrom(__DIR__.'/../Translations/domains', 'domain');
        $this->loadViewsFrom(__DIR__.'/../Views/domains', 'domain');
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
       $this->app->bind(DomainContract::class, DomainEloquent::class);
        $this->app->singleton('DomainService', function ($app) {
            return new DomainService($app->make(DomainContract::class));
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
            'DomainService'
        ];
    }
    */
}
