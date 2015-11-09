<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class CategoryProvider extends ServiceProvider
{

    protected $defer = true;

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('\App\iCategoryFinder', function ($app)
        {
            return new \App\DbCategoryFinder();
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['\App\iCategoryFinder'];
    }
}
