<?php

namespace App\Providers;

use App\EmailMailer;
use Illuminate\Support\ServiceProvider;


class MailServiceProvider extends ServiceProvider
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
        $this->app->bind('App\iMailer', 'App\EmailMailer');

        /*
        $this->app->singleton('App\iMailer', function ($app)
        {
            return new EmailMailer();
        });
        */
    }

    public function provides()
    {
        return ['App\iMailer'];
    }
}
