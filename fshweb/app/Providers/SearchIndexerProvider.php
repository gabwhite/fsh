<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class SearchIndexerProvider extends ServiceProvider
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
        $this->app->singleton('\App\iSearchIndexBuilder', function ($app)
        {
            return new \App\LuceneSearchIndexBuilder();
        });
    }
}
