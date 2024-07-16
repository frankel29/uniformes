<?php

namespace App\Filament\Widgets;

use App\Filament\Resources\OrderResource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Actions\Action;
use App\Models\Order;
use Filament\Widgets\TableWidget as BaseWidget;


class LatestOrders extends BaseWidget
{
    protected int|string|array $columnSpan = 'full';

    protected static ?int $sort = 2;

    public function table(Table $table): Table
    {
        return $table
            ->query(OrderResource::getEloquentQuery())
            ->defaultPaginationPageOption(5)
            ->defaultSort('created_at', 'desc')        
            ->columns([
                TextColumn::make('id')
                    ->label('ID de Pedido')
                    ->searchable(),


                    TextColumn::make('user.name')
                    ->label('Usuario')
                    ->searchable(),

                TextColumn::make('grand_total')
                ->label('Total Pedido')
                    ->money('USD'),
                TextColumn::make('status')
                    ->label('Estado')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'new' => 'info',
                        'processing' => 'warning',
                        'shipped' => 'success',
                        'delivered' => 'success',
                        'cancelled' => 'danger'
                    })
                    ->icon(fn(string $state): string => match ($state) {
                        'new' => 'heroicon-o-sparkles',
                        'processing' => 'heroicon-o-arrow-path',
                        'shipped' => 'heroicon-o-truck',
                        'delivered' => 'heroicon-o-check-badge',
                        'cancelled' => 'heroicon-o-x-circle'
                    })
                    ->sortable(),
                /*TextColumn::make('payment_method')
                    ->sortable()
                    ->searchable(),*/
                /*TextColumn::make('payment_status')
                    ->sortable()
                    ->badge()
                    ->searchable(),*/
                TextColumn::make('created_at')
                    ->label('Creación Pedido')
                    ->dateTime(),
            ])
            ->actions([
                Action::make('View Order')
                    ->url(fn (Order $record): string => OrderResource::getUrl('view', ['record' => $record]))
                    ->icon('heroicon-m-eye'),
            ]);
            
    }
}
