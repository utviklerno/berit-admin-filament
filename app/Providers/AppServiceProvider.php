<?php

namespace App\Providers;

use App\Models\AdminUser;
use App\Models\Page;
use App\Models\Subpage;
use App\Models\Menu;
use App\Models\MenuItem;
use App\Models\User;
use App\Models\Folder;
use App\Models\File;
use App\Models\ProductType;
use App\Models\ProductTypeItem;
use App\Observers\ActivityLogObserver;
use Filament\Support\Colors\Color;
use Filament\Support\Facades\FilamentColor;
use Filament\Tables\Table;
use Filament\Actions\Action;
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
        Page::observe(ActivityLogObserver::class);
        Subpage::observe(ActivityLogObserver::class);
        Menu::observe(ActivityLogObserver::class);
        MenuItem::observe(ActivityLogObserver::class);
        User::observe(ActivityLogObserver::class);
        Folder::observe(ActivityLogObserver::class);
        File::observe(ActivityLogObserver::class);
        ProductType::observe(ActivityLogObserver::class);
        ProductTypeItem::observe(ActivityLogObserver::class);

        Action::configureUsing(function (Action $action) {
            match ($action->getName()) {
                "delete" => $action->view("vendor.filament.actions.delete"),
                "edit" => $action->view("vendor.filament.actions.edit"),
                "view" => $action->view("vendor.filament.actions.view"),
                default => null,
            };
        });

        if (
            config("app.force_https") ||
            $this->app->environment("production")
        ) {
            URL::forceScheme("https");
        }

        Gate::define("manage_settings", function (AdminUser $user) {
            // For now, allow all admin users to manage settings
            // You can implement more granular permissions here
            return true;
        });
        Table::configureUsing(function (Table $table): void {
            $table
                ->defaultPaginationPageOption(25)
                ->paginationPageOptions([10, 25, 50, 100]);
        });

        FilamentColor::register([
            "danger" => Color::Rose,
            "gray" => Color::Stone,
            "info" => Color::Sky,
            "primary" => Color::Amber,
            "success" => Color::Emerald,
            "warning" => Color::Yellow,
        ]);
    }
}
