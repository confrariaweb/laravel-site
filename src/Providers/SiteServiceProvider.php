<?php

namespace Confrariaweb\Site\Providers;

use Illuminate\Support\ServiceProvider;

use Confrariaweb\Site\Repositories\Contracts\SiteContract;
use Confrariaweb\Site\Repositories\Contracts\SiteConfigurationContract;
use Confrariaweb\Site\Repositories\Eloquent\SiteEloquent;
use Confrariaweb\Site\Repositories\Eloquent\SiteConfigurationEloquent;
use Confrariaweb\Site\Services\SiteService;
use Confrariaweb\Site\Services\SiteConfigurationService;
use App;

class SiteServiceProvider extends ServiceProvider
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
        if(!App::runningInConsole()) {
            abort_unless(domain_account(), 404);
        }

        /*Testar se vai ser sobrescrito quando houver rotas no proprio template*/
        $this->loadRoutesFrom(__DIR__ . '/../Routes/sites/site.php');
        /*
         * Verifica se existe o arquivo de rotas próprio do template
         */
        if(!App::runningInConsole()) {
            $routeSite = base_path('vendor/confrariaweb/' . domain_template_package() . '/src/Routes/web.php');
            if (file_exists($routeSite)) {
                $this->loadRoutesFrom($routeSite);
            }
            /*
            else{
                $this->loadRoutesFrom(__DIR__ . '/../Routes/sites/site.php');
            }
            */
        }
        $this->loadRoutesFrom(__DIR__ . '/../Routes/sites/web.php');
        $this->loadMigrationsFrom(__DIR__ . '/../Databases/Migrations/sites');
        $this->loadTranslationsFrom(__DIR__ . '/../Translations/sites', 'site');
        $this->loadViewsFrom(__DIR__ . '/../Views/sites', 'site');
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
       $this->app->bind(SiteContract::class, SiteEloquent::class);
        $this->app->singleton('SiteService', function ($app) {
            return new SiteService($app->make(SiteContract::class));
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
            'SiteService'
        ];
    }
    */
    
}
