<?php

use Illuminate\Support\Facades\Route;
use App\Filament\Pages\CustomPage;

// Grupo de rutas con prefijo y middleware predeterminados de Filament
Route::middleware(config('filament.middleware.auth'))
    ->prefix(config('filament.path'))
    ->group(function () {
        // Ruta al Dashboard (ya registrada automáticamente)
        Route::get('/', function () {
            return redirect()->route('filament.pages.dashboard');
        });

});
