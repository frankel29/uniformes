<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;
use App\Models\Order;
use Carbon\Carbon;

class OrdersChart extends ChartWidget
{
    protected static ?string $heading = 'Ordenes';
    
    protected static ?int $sort = 4;

    protected function getData(): array
    {
        $data = $this->getOrdersPerMonth();

        return [
            'datasets' => [
                [
                    'label' => 'Ordenes por mes',
                    'data' => $data['ordersPerMonth'],
                ],
            ],
            'labels' => $data['months'],
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }

    private function getOrdersPerMonth(): array
    {
        $now = Carbon::now();
        $ordersPerMonth = [];
        $months = collect(range(1, 12))->map(function($month) use ($now, &$ordersPerMonth) {
            $count = Order::whereMonth('created_at', $month)
                ->whereYear('created_at', $now->year)
                ->count();
            $ordersPerMonth[] = $count;

            return $now->month($month)->format('M');
        })->toArray();

        return [
            'ordersPerMonth' => $ordersPerMonth,
            'months' => $months,
        ];
    }
}