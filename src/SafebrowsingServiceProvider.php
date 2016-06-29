<?php

namespace Snipe\Safebrowsing;

use Illuminate\Support\ServiceProvider;
use Illuminate\Routing\Router;

class SafebrowsingServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        // use this if your package has views
        // $this->loadViewsFrom(realpath(__DIR__.'/resources/views'), 'safebrowsing');

        // Pull in the language files
        //$this->loadTranslationsFrom( __DIR__.'/Lang', 'safebrowsing');

        // // use this if your package has routes
        // $this->setupRoutes($this->app->router);

        // Our package uses a config file, so enable the user to publish it.
        // This will copy our src/Config/safebrowsing.php to config/safebrowsing.php
        $this->publishes([
             __DIR__.'/Config/safebrowsing.php' => config_path('safebrowsing.php'),
         ]);

        // use the vendor configuration file as fallback
        // $this->mergeConfigFrom(
        //      __DIR__.'/config/config.php', 'safebrowsing'
        // );
    }

    /**
     * Define the routes for the application.
     *
     * @param  \Illuminate\Routing\Router  $router
     * @return void
     */
    public function setupRoutes(Router $router)
    {
        // $router->group(['namespace' => 'League\Skeleton\Http\Controllers'], function($router)
        // {
        //     require __DIR__.'/Http/routes.php';
        // });
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register()
    {
        $this->registerSafebrowsing();
        $this->mergeConfigFrom( __DIR__.'/Config/safebrowsing.php', 'safebrowsing');
    }

    private function registerSafebrowsing()
    {
        $this->app->bind('safebrowsing',function($app){
            return new Safebrowsing($app);
        });
    }
}
