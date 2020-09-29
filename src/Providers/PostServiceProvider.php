<?php

namespace Confrariaweb\Site\Providers;

use Illuminate\Support\ServiceProvider;

use Confrariaweb\Site\Repositories\Contracts\PostContract;
use Confrariaweb\Site\Repositories\Eloquent\PostEloquent;
use Confrariaweb\Site\Services\PostService;

class PostServiceProvider extends ServiceProvider
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
        $this->loadRoutesFrom(__DIR__.'/../Routes/posts/web.php');
        $this->loadMigrationsFrom(__DIR__ . '/../Databases/Migrations/posts');
        $this->loadTranslationsFrom(__DIR__.'/../Translations/posts', 'post');
        $this->loadViewsFrom(__DIR__.'/../Views/posts', 'post');
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
       $this->app->bind(PostContract::class, PostEloquent::class);
        $this->app->singleton('PostService', function ($app) {
            return new PostService($app->make(PostContract::class));
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
            'PostService'
        ];
    }
    */
}
