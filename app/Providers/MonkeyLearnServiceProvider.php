<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use MonkeyLearn\Client as MonkeyLearn;

class MonkeyLearnServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('monkeylearn', function($app) 
        {
            return new MonkeyLearn(env('MONKEYLEARN_SECRET'));
        });
    }
}
