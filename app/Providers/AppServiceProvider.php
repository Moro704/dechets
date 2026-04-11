<?php

namespace App\Providers;

use App\Models\Abonnements;
use App\Observers\AbonnementsObserver;
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
        // Enregistrement de l'Observer
        Abonnements::observe(AbonnementsObserver::class);
    }
}