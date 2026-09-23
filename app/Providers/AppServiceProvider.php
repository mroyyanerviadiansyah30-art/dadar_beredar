<?php

namespace App\Providers;

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
        try {
            if (\Illuminate\Support\Facades\Schema::hasTable('outlets')) {
                \Illuminate\Support\Facades\View::composer('*', function ($view) {
                    $globalOutlets = \App\Models\Outlet::where('is_active', true)->orderBy('city')->get();
                    $primaryOutlet = $globalOutlets->firstWhere('slug', 'dadar-beredar-sidoarjo') ?? $globalOutlets->first();
                    $view->with('globalOutlets', $globalOutlets)
                         ->with('primaryOutlet', $primaryOutlet);
                });
            }
        } catch (\Throwable $e) {
            // Silently ignore during CLI or initial migration setup
        }
    }
}
