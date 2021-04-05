<?php

namespace App\Providers;

use App\Models\Socialite;
use Illuminate\Support\ServiceProvider;

class GlobalDataServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [];
    }

    /**
     * Boot the observers.
     *
     */
    public function boot ()
    {
        if (!app()->runningInConsole()) {
            // share socialite settings data
            view()->share('global_socialite', Socialite::first());
        }
    }
}
