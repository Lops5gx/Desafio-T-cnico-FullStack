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
        $this->app->singleton('App\Interfaces\InstituitionsInterface', 'App\Repositories\InstituitionsRepository');
        $this->app->singleton('App\Interfaces\ConventionInterface',    'App\Repositories\ConventionRepository');
        $this->app->singleton('App\Interfaces\SimulationInterface',    'App\Repositories\SimulationRepository');
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}