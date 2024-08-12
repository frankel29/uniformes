<?php

namespace App\Filament\Resources\ReporteUsuariosResource\Pages;

use App\Filament\Resources\ReporteUsuariosResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListReporteUsuarios extends ListRecords
{
    protected static string $resource = ReporteUsuariosResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
            Actions\Action::make('download')
            ->label('Descargar')
            ->icon('heroicon-o-arrow-down-tray')
            ->url(route('user-report.download'))
            ->color('primary'),
        ];
    }
}
