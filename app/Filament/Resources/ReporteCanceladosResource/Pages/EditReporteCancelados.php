<?php

namespace App\Filament\Resources\ReporteCanceladosResource\Pages;

use App\Filament\Resources\ReporteCanceladosResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditReporteCancelados extends EditRecord
{
    protected static string $resource = ReporteCanceladosResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
