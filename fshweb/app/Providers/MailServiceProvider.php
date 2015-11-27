<?php

namespace App\Providers;

use App\EmailMailer;
use Illuminate\Support\ServiceProvider;


class MailServiceProvider extends ServiceProvider
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
        $this->app->singleton('App\iMailer', function ($app)
        {
            return new EmailMailer();
        });
    }
}
