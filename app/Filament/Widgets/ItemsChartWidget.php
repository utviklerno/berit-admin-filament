<?php

namespace App\Filament\Widgets;

use App\Models\ProductType;
use App\Models\UserItem;
use Filament\Widgets\ChartWidget;

class ItemsChartWidget extends ChartWidget
{
    protected ?string $heading = 'Items by Product Type';
    
    protected static ?int $sort = 3;

    protected function getData(): array
    {
        $productTypes = ProductType::withCount('userItems')
            ->orderBy('user_items_count', 'desc')
            ->limit(10)
            ->get();

        return [
            'datasets' => [
                [
                    'label' => 'Items per Product Type',
                    'data' => $productTypes->pluck('user_items_count'),
                    'backgroundColor' => [
                        'rgb(255, 99, 132)',
                        'rgb(54, 162, 235)', 
                        'rgb(255, 205, 86)',
                        'rgb(75, 192, 192)',
                        'rgb(153, 102, 255)',
                        'rgb(255, 159, 64)',
                        'rgb(199, 199, 199)',
                        'rgb(83, 102, 255)',
                        'rgb(255, 99, 255)',
                        'rgb(99, 255, 132)',
                    ],
                ],
            ],
            'labels' => $productTypes->pluck('name'),
        ];
    }

    protected function getType(): string
    {
        return 'doughnut';
    }
}
