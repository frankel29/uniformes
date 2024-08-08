<?php

namespace App\Filament\Resources\ReporteVentasResource\Pages;

use App\Filament\Resources\ReporteVentasResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditReporteVentas extends EditRecord
{
    protected static string $resource = ReporteVentasResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
