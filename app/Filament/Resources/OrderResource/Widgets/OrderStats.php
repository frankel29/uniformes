<?php

namespace App\Filament\Resources\OrderResource\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\Order;
use Illuminate\Support\Number;

class OrderStats extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Nuevas Ordenes', Order::query()->where('status','new')->count()),
            Stat::make('Ordenes Procesadas', Order::query()->where('status','processing')->count()),
            Stat::make('Orden enviada', Order::query()->where('status','shipped')->count()),
            Stat::make('Precio Promedio', Number::currency(Order::query()->avg('grand_total')), 'USD')


        ];
    }
}
