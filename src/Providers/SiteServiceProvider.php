<?php

namespace ConfrariaWeb\Site\Providers;

use ConfrariaWeb\Site\Contracts\SiteMenuContract;
use ConfrariaWeb\Site\Contracts\SiteContract;
use ConfrariaWeb\Site\Models\Site;
use ConfrariaWeb\Site\Observers\SiteObserver;
use ConfrariaWeb\Site\Repositories\SiteMenuRepository;
use ConfrariaWeb\Site\Repositories\SiteRepository;
use ConfrariaWeb\Site\Services\SiteMenuService;
use ConfrariaWeb\Site\Services\SiteService;
use ConfrariaWeb\Vendor\Traits\ProviderTrait;
use Illuminate\Support\ServiceProvider;

class SiteServiceProvider extends ServiceProvider
{
    use ProviderTrait;

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__ . '/../Routes/web.php');
        $this->loadMigrationsFrom(__DIR__ . '/../../databases/Migrations');
        $this->loadViewsFrom(__DIR__ . '/../Views/backend', 'site');
        $this->loadViewsFrom(__DIR__ . '/../Views/frontend', 'siteFrontend');
        //$this->registerSeedsFrom(__DIR__ . '/../../databases/Seeds');
        $this->publishes([__DIR__ . '/../../config/cw_site.php' => config_path('cw_site.php')], 'config');

        Site::observe(SiteObserver::class);
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(SiteContract::class, SiteRepository::class);
        $this->app->singleton('SiteService', function ($app) {
            return new SiteService($app->make(SiteContract::class));
        });

        $this->app->bind(SiteMenuContract::class, SiteMenuRepository::class);
        $this->app->singleton('SiteMenuService', function ($app) {
            return new SiteMenuService($app->make(SiteMenuContract::class));
        });
    }

}
