<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ReporteVentasResource\Pages;
use App\Models\Order;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\SelectColumn;

class ReporteVentasResource extends Resource
{
    protected static ?string $model = Order::class;

    protected static ?string $navigationGroup = 'Ventas';
    
    protected static ?string $navigationLabel = 'Reporte de Ventas';


    protected static ?string $navigationIcon = 'heroicon-o-chart-bar';

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

                TextColumn::make('payment_status')
                    ->label('Estado del pago')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('currency')
                    ->label('Moneda')
                    ->sortable()
                    ->searchable(),

                SelectColumn::make('status')
                    ->label('Estado')
                    ->options([
                        'new' => 'Nuevo',
                        'processing' => 'Procesando',
                        'delivered' => 'Entregado',
                        'cancelled' => 'Cancelado'
                    ])
                    ->sortable()
                    ->searchable(),

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
                // Agrega filtros si es necesario
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListReporteVentas::route('/'),
        ];
    }
}
