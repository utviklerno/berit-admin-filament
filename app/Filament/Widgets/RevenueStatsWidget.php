<?php

namespace App\Filament\Widgets;

use App\Models\UserItem;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\DB;

class RevenueStatsWidget extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        $totalRevenue = UserItem::where('active', true)->sum('price') / 100;
        $averageItemPrice = UserItem::where('active', true)->avg('price') / 100;
        $highestPriceItem = UserItem::where('active', true)->max('price') / 100;
        $totalActiveListings = UserItem::where('active', true)->count();

        // Revenue by price interval
        $dailyRevenue = UserItem::where('active', true)
            ->where('price_interval_type', 'day')
            ->sum('price') / 100;
        $monthlyRevenue = UserItem::where('active', true)
            ->where('price_interval_type', 'month')
            ->sum('price') / 100;

        return [
            Stat::make('Total Potential Revenue', '$' . number_format($totalRevenue, 2))
                ->description('Sum of all active item prices')
                ->descriptionIcon('heroicon-m-currency-dollar')
                ->color('success')
                ->chart($this->getRevenueChart()),
                
            Stat::make('Average Item Price', '$' . number_format($averageItemPrice, 2))
                ->description('Mean price across all items')
                ->descriptionIcon('heroicon-m-calculator')
                ->color('primary'),
                
            Stat::make('Highest Priced Item', '$' . number_format($highestPriceItem, 2))
                ->description('Most expensive active listing')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('warning'),
                
            Stat::make('Active Listings', number_format($totalActiveListings))
                ->description('Items available for rent')
                ->descriptionIcon('heroicon-m-list-bullet')
                ->color('info'),
        ];
    }

    private function getRevenueChart(): array
    {
        $data = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = now()->subDays($i);
            $revenue = UserItem::whereDate('created_at', $date)
                ->where('active', true)
                ->sum('price') / 100;
            $data[] = (int) $revenue;
        }
        return $data;
    }
}
