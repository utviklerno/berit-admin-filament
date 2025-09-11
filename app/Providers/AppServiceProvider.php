<?php

namespace App\Providers;

use Filament\Tables\Table;
use App\Models\AdminUser;
use Illuminate\Support\Facades\Gate;
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
        Gate::define('manage_settings', function (AdminUser $user) {
            // For now, allow all admin users to manage settings
            // You can implement more granular permissions here
            return true;
        });
        Table::configureUsing(function (Table $table): void {
            $table->defaultPaginationPageOption(25)
                  ->paginationPageOptions([10, 25, 50, 100]);
        });
    }
}
