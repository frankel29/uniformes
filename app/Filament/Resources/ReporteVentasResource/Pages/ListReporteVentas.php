<?php

namespace App\Filament\Resources\ReporteVentasResource\Pages;

use App\Filament\Resources\ReporteVentasResource;
use Filament\Pages\Actions;
use Filament\Pages\Actions\Action;
use Filament\Resources\Pages\ListRecords;

class ListReporteVentas extends ListRecords
{
    protected static string $resource = ReporteVentasResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
            Action::make('descargar')
            ->label('Descargar')
            ->icon('heroicon-o-arrow-down-tray')
            ->url(route('reporte-ventas.descargar')),
        ];
    }
}
