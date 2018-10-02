<?php

namespace Tongnd\Languages;

use Illuminate\Support\ServiceProvider;

class LanguagesServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
        if (! $this->app->routesAreCached()) {
            require __DIR__.'/routes/web.php';
        }
        $this->loadViewsFrom(__DIR__.'/views', 'Languages');
        $this->loadMigrationsFrom(__DIR__.'/migrations');
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
