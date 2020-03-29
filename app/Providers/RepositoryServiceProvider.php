<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(\App\Repositories\PropertyRepository::class, \App\Repositories\PropertyRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\AnalyticTypesRepository::class, \App\Repositories\AnalyticTypesRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\PropertyAnalyticRepository::class, \App\Repositories\PropertyAnalyticRepositoryEloquent::class);
        //:end-bindings:
    }
}
