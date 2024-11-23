<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Filament\Support\Colors\Color;
use Filament\Support\Facades\FilamentColor;

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
        FilamentColor::register([
            'danger' => '#C51E3A', 
            'gray' => '#324AB2',         
            'info' => '#65000B',         // Color personalizado
            'primary' => '#FFFFFF',      // Color personalizado
            'success' => '#3EB489',      // Color personalizado
            'warning' => '#65000B',      // Color personalizado
        ]);
    }
}
