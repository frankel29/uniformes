<?php

namespace App\Filament\Resources\OrderResource\Pages;

use App\Filament\Resources\OrderResource;
use App\Filament\Resources\OrderResource\Widgets\OrderStats;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Resources\Components\Tab;



class ListOrders extends ListRecords
{
    protected static string $resource = OrderResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    protected function getHeaderWidgets(): array{
        return[
            OrderStats::class
        ];
    }

    public function getTabs(): array{
        return[
            null=> Tab::make('All'),
            'nuevo'=> Tab::make()->query(fn ($query)=> $query->where('status','new')),
            'procesando'=> Tab::make()->query(fn ($query)=> $query->where('status','processing')),
            'entregado'=> Tab::make()->query(fn ($query)=> $query->where('status','shipped')),
            'enviado'=> Tab::make()->query(fn ($query)=> $query->where('status','delivered')),
            'cancelado'=> Tab::make()->query(fn ($query)=> $query->where('status','cancelled'))

        ];
    }
}
