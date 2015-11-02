<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ProductImportProvider extends ServiceProvider
{
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
}
