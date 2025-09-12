<?php

namespace App\Filament\Widgets;

use App\Models\UserItem;
use Filament\Widgets\ChartWidget;

class RevenueChartWidget extends ChartWidget
{
    protected ?string $heading = 'Revenue Trend (Last 30 Days)';
    
    protected static ?int $sort = 4;

    protected function getData(): array
    {
        $data = [];
        $labels = [];
        
        for ($i = 29; $i >= 0; $i--) {
            $date = now()->subDays($i);
            $revenue = UserItem::whereDate('created_at', $date)
                ->where('active', true)
                ->sum('price') / 100;
            
            $data[] = $revenue;
            $labels[] = $date->format('M j');
        }

        return [
            'datasets' => [
                [
                    'label' => 'Daily Revenue ($)',
                    'data' => $data,
                    'borderColor' => 'rgb(75, 192, 192)',
                    'backgroundColor' => 'rgba(75, 192, 192, 0.2)',
                    'fill' => true,
                ],
            ],
            'labels' => $labels,
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }

    protected function getOptions(): array
    {
        return [
            'scales' => [
                'y' => [
                    'beginAtZero' => true,
                ],
            ],
        ];
    }
}
