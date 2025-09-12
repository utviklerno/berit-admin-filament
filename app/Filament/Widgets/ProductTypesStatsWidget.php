<?php

namespace App\Filament\Widgets;

use App\Models\ProductType;
use App\Models\UserLocation;
use App\Models\UserItem;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\DB;

class ProductTypesStatsWidget extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        $totalProductTypes = ProductType::count();
        $totalLocations = UserLocation::count();
        $locationsWithItems = UserLocation::whereHas('items')->count();
        $mostPopularProductType = ProductType::withCount('userItems')
            ->orderBy('user_items_count', 'desc')
            ->first();

        return [
            Stat::make('Product Types', $totalProductTypes)
                ->description('Available product categories')
                ->descriptionIcon('heroicon-m-tag')
                ->color('primary'),
                
            Stat::make('User Locations', $totalLocations)
                ->description('Total registered locations')
                ->descriptionIcon('heroicon-m-building-office')
                ->color('success'),
                
            Stat::make('Active Locations', $locationsWithItems)
                ->description('Locations with items')
                ->descriptionIcon('heroicon-m-map-pin')
                ->color('info'),
                
            Stat::make('Most Popular', $mostPopularProductType ? $mostPopularProductType->name : 'N/A')
                ->description('Most used product type')
                ->descriptionIcon('heroicon-m-fire')
                ->color('warning'),
        ];
    }
}
