<?php

namespace App\Filament\Widgets;

use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\DB;

class UsersStatsWidget extends BaseWidget
{
    protected function getStats(): array
    {
        $totalUsers = User::count();
        $activeUsers = User::whereHas('items', function($query) {
            $query->where('active', true);
        })->count();
        $newUsersThisMonth = User::whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->count();
        $usersWithLocations = User::whereHas('locations')->count();

        return [
            Stat::make('Total Users', $totalUsers)
                ->description('All registered users')
                ->descriptionIcon('heroicon-m-users')
                ->color('primary')
                ->chart($this->getUsersGrowthChart()),
                
            Stat::make('Active Users', $activeUsers)
                ->description('Users with active items')
                ->descriptionIcon('heroicon-m-check-circle')
                ->color('success'),
                
            Stat::make('New This Month', $newUsersThisMonth)
                ->description('Users registered this month')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('info'),
                
            Stat::make('Users with Locations', $usersWithLocations)
                ->description('Users who have added locations')
                ->descriptionIcon('heroicon-m-map-pin')
                ->color('warning'),
        ];
    }

    private function getUsersGrowthChart(): array
    {
        $data = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = now()->subDays($i);
            $count = User::whereDate('created_at', $date)->count();
            $data[] = $count;
        }
        return $data;
}
}
