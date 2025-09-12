<?php

namespace App\Filament\Widgets;

use App\Models\UserItem;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\DB;

class ItemsStatsWidget extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        $totalItems = UserItem::count();
        $activeItems = UserItem::where('active', true)->count();
        $itemsWithImages = UserItem::whereNotNull('images')
            ->where('images', '!=', '{}')
            ->where('images', '!=', '[]')
            ->count();
        $averagePrice = UserItem::where('active', true)->avg('price') ?? 0;

        return [
            Stat::make('Total Items', $totalItems)
                ->description('All items in system')
                ->descriptionIcon('heroicon-m-cube')
                ->color('primary')
                ->chart($this->getItemsGrowthChart()),
                
            Stat::make('Active Items', $activeItems)
                ->description('Currently active listings')
                ->descriptionIcon('heroicon-m-eye')
                ->color('success'),
                
            Stat::make('Items with Images', $itemsWithImages)
                ->description('Items that have photos')
                ->descriptionIcon('heroicon-m-photo')
                ->color('info'),
                
            Stat::make('Average Price', '$' . number_format($averagePrice / 100, 2))
                ->description('Average item price')
                ->descriptionIcon('heroicon-m-currency-dollar')
                ->color('warning'),
        ];
    }

    private function getItemsGrowthChart(): array
    {
        $data = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = now()->subDays($i);
            $count = UserItem::whereDate('created_at', $date)->count();
            $data[] = $count;
        }
        return $data;
    }
}
