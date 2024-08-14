<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ReporteCanceladosResource\Pages;
use App\Filament\Resources\ReporteCanceladosResource\RelationManagers;
use App\Models\ReporteCancelados;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Models\Order;
use Filament\Tables\Columns\TextColumn;

class ReporteCanceladosResource extends Resource
{
    protected static ?string $model = Order::class;

    protected static ?string $navigationGroup = 'Reportes';
    
    protected static ?string $navigationLabel = 'Órdenes Canceladas';

    protected static ?string $navigationIcon = 'heroicon-o-x-circle';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('user.name')
                ->label('Cliente')
                ->sortable()
                ->searchable(),

                TextColumn::make('grand_total')
                ->label('Total')
                ->numeric()
                ->sortable()
                ->money('USD'),

                TextColumn::make('created_at')
                ->label('Creado en')
                ->dateTime()
                ->sortable(),

                TextColumn::make('updated_at')
                ->label('Editado en')
                ->dateTime()
                ->sortable(),
            ])
            ->filters([
                // Filtro para solo mostrar órdenes canceladas
                Tables\Filters\SelectFilter::make('status')
                ->label('Estado')
                ->options([
                'cancelled' => 'Cancelado'
                ])
                ->default('cancelled'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListReporteCancelados::route('/'),
            'create' => Pages\CreateReporteCancelados::route('/create'),
            'edit' => Pages\EditReporteCancelados::route('/{record}/edit'),
        ];
    }
}
