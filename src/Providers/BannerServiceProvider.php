<?php

namespace Confrariaweb\Site\Providers;

use Illuminate\Support\ServiceProvider;

use Confrariaweb\Site\Repositories\Contracts\BannerContract;
use Confrariaweb\Site\Repositories\Eloquent\BannerEloquent;
use Confrariaweb\Site\Services\BannerService;
use App;

class BannerServiceProvider extends ServiceProvider
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
        $this->loadRoutesFrom(__DIR__ . '/../Routes/banners/web.php');
        $this->loadTranslationsFrom(__DIR__ . '/../Translations/banners', 'siteBanner');
        $this->loadViewsFrom(__DIR__ . '/../Views/banners', 'siteBanner');
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
       $this->app->bind(BannerContract::class, BannerEloquent::class);
        $this->app->singleton('BannerService', function ($app) {
            return new BannerService($app->make(BannerContract::class));
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
            'BannerService'
        ];
    }
    */
    
}
