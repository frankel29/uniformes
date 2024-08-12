<?php

namespace App\Filament\Resources\ReporteUsuariosResource\Pages;

use App\Filament\Resources\ReporteUsuariosResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditReporteUsuarios extends EditRecord
{
    protected static string $resource = ReporteUsuariosResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
