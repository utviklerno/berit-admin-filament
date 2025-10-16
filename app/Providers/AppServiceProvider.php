<?php

namespace App\Providers;

use App\Models\AdminUser;
use Filament\Support\Colors\Color;
use Filament\Support\Facades\FilamentColor;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\URL;
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
        if (config('app.force_https') || $this->app->environment('production')) {
            URL::forceScheme('https');
        }

        Gate::define('manage_settings', function (AdminUser $user) {
            // For now, allow all admin users to manage settings
            // You can implement more granular permissions here
            return true;
        });
        Table::configureUsing(function (Table $table): void {
            $table->defaultPaginationPageOption(25)
                  ->paginationPageOptions([10, 25, 50, 100]);
        });

        FilamentColor::register([
            'danger' => Color::Rose,
            'gray' => Color::Stone,
            'info' => Color::Sky,
            'primary' => Color::Amber,
            'success' => Color::Emerald,
            'warning' => Color::Yellow,
        ]);
    }
}
