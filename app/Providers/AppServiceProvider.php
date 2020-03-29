<?php

namespace App\Providers;

use App\Repositories\AnalyticTypesRepository;
use App\Repositories\AnalyticTypesRepositoryEloquent;
use App\Repositories\PropertyAnalyticRepository;
use App\Repositories\PropertyAnalyticRepositoryEloquent;
use App\Repositories\PropertyRepository;
use App\Repositories\PropertyRepositoryEloquent;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(PropertyAnalyticRepository::class, PropertyAnalyticRepositoryEloquent::class);
        $this->app->bind(PropertyRepository::class, PropertyRepositoryEloquent::class);
        $this->app->bind(AnalyticTypesRepository::class, AnalyticTypesRepositoryEloquent::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
