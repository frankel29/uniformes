<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;
use App\Models\Product;
use Carbon\Carbon;

class ProductsChart extends ChartWidget
{
    protected static ?string $heading = 'Uniformes';

    protected static ?int $sort = 3;

    protected static string $color = 'danger';

    protected function getData(): array
    {
        $data = $this->getProductsPerMonth();

        return [
            'datasets' => [
                [
                    'label' => 'Uniformes por mes',
                    'data' => $data['productsPerMonth'],
                ],
            ],
            'labels' => $data['months'],
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }

    private function getProductsPerMonth(): array
    {
        $now = Carbon::now();
        $productsPerMonth = [];
        $months = collect(range(1, 12))->map(function($month) use ($now, &$productsPerMonth) {
            $count = Product::whereMonth('created_at', $month)
                ->whereYear('created_at', $now->year)
                ->count();
            $productsPerMonth[] = $count;

            return $now->month($month)->format('M');
        })->toArray();

        return [
            'productsPerMonth' => $productsPerMonth,
            'months' => $months,
        ];
    }
}
