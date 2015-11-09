<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ProductImportProvider extends ServiceProvider
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
        $this->app->singleton('\App\iProductImporter', function ($app)
        {
            return new \App\CsvProductImporter();
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['\App\iProductImporter'];
    }
}
