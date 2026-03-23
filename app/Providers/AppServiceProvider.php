<?php

namespace App\Providers;

use App\Models\Simulation;
use App\Observers\SimulationObserver;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Simulation::observe(SimulationObserver::class);
    }
}
