<?php

namespace App\Filament\Resources\ReporteCanceladosResource\Pages;

use App\Filament\Resources\ReporteCanceladosResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Pages\Actions\Action;

class ListReporteCancelados extends ListRecords
{
    protected static string $resource = ReporteCanceladosResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
            Action::make('descargar')
            ->label('Descargar')
            ->action(function () {
                return redirect()->route('cancelled-orders.downloadPdf');
            })
            ->icon('heroicon-o-arrow-down-tray'),
        ];
    }
}
