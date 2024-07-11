<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OrderResource\Pages;
use App\Filament\Resources\OrderResource\RelationManagers;
use App\Models\Order;
use App\Models\Product;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\ToggleButtons;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\SelectColumn;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\DeleteAction;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class OrderResource extends Resource
{
    protected static ?string $model = Order::class;

    protected static ?string $navigationIcon = 'heroicon-o-shopping-bag';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Group::make()->schema([
                    Section::make('Informacion_de_la_orden')
                    ->schema([
                        Select::make('user_id')
                            ->label('Customer')
                            ->relationship('user', 'name')
                            ->searchable()
                            ->preload()
                            ->required(),
                        
                            Select::make('payment_method')
                            ->options([
                                'stripe'=> 'Stripe',
                                'cod'=> 'Cash on Delivery'
                            ])
                            ->required(),
            
                            Select::make('payment_status')
                            ->options([
                                'pending'=>'Pendiente',
                                'paid'=>'Pagado',
                                'failed'=>'Fallido'
                            ])
                            ->default('pending')
                            ->required(),

                            ToggleButtons::make('status')
                            ->inline()
                            ->default('new')
                            ->required()
                            ->options([
                                'new'=> 'Nuevo',
                                'processing'=>'Procesando',
                                'delivered'=>'Entregado',
                                'shipped'=>'Enviado',
                                'cancelled'=>'Cancelado'
                            ])
                            ->colors([
                                'new'=> 'info',
                                'processing'=>'warning',
                                'delivered'=>'success',
                                'shipped'=>'success',
                                'cancelled'=>'danger'
                            ])
                            ->icons([
                                'new'=> 'heroicon-m-sparkles',
                                'processing'=>'heroicon-m-arrow-path',
                                'delivered'=>'heroicon-m-truck',
                                'shipped'=>'heroicon-m-check-badge',
                                'cancelled'=>'heroicon-m-x-circle'
                            ]),

                            Select::make('currency')
                                ->options([
                                'inr'=>'INR',
                                'usd'=>'USD',
                                'eur'=>'EUR',
                                'gbp'=>'GBP'
                            ])
                            ->default('usd')
                            ->required(),

                            Select::make('shipping_method')
                            ->options([
                                'fedex'=>'FedEx',
                                'ups'=>'UPS',
                                'dhl'=>'DHl',
                                'usps'=>'USPS'

                            ]),

                            Textarea::make('notes')
                            ->columnSpanFull()
                    ])->columns(2),

                    Section::make('Articiulo Ordenado')->schema([
                        Repeater::make('items')
                        ->relationship()
                        ->schema([
                            Select::make('product_id')
                            ->relationship('product', 'name')
                            ->searchable()
                            ->preload()
                            ->required()
                            ->distinct()
                            ->disableOptionsWhenSelectedInSiblingRepeaterItems()
                            ->columnSpan(4)
                            ->reactive()
                            ->afterStateUpdated(fn ($state, Set $set) => $set('unit_amount', Product::find($state)?->price ?? 0))
                            ->afterStateUpdated(fn ($state, Set $set) => $set('total_amount', Product::find($state)?->price ?? 0)),

                            TextInput::make('quantity')
                            ->numeric()
                            ->required()
                            ->default(1)
                            ->minValue(1)
                            ->columnSpan(2)
                            ->reactive()
                            ->afterStateUpdated(fn ($state, Set $set, Get $get) => $set('total_amount',$state*$get
                            ('unit_amount'))),

                            TextInput::make('unit_amount')
                            ->numeric()
                            ->required()
                            ->disabled()
                            ->dehydrated()
                            ->columnSpan(3),

                            TextInput::make('total_amount')
                            ->numeric()
                            ->required()
                            ->dehydrated()
                            ->columnSpan(3),



                        ])->columns(12),

                        Placeholder::make('grand_total_placeholder')
                        ->label('Grand Total')
                        ->content(function(Get $get, Set $set) {
                            $total = 0;
                            if (!$repeaters = $get('items')) {
                            return $total;
                            }
                            foreach ($repeaters as $key => $repeater) {
                                $total += $get("items.{$key}.total_amount");
                            }
                            $set('grand_total', $total);
                            return '$' . number_format($total, 2);
                         }),

                         Hidden::make('grand_total')
                         ->default(0)

                    ])
                ])->columnSpanFull()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('user.name') 
                ->label('Customer')
                ->sortable()
                ->searchable(),

                TextColumn::make('grand_total') 
                ->numeric()
                ->sortable()
                ->money('USD'),

                TextColumn::make('payment_method') 
                ->sortable()
                ->searchable(),

                TextColumn::make('payment_status') 
                ->sortable()
                ->searchable(),

                TextColumn::make('currency') 
                ->sortable()
                ->searchable(),

                TextColumn::make('shipping_method') 
                ->sortable()
                ->searchable(),

                SelectColumn::make('status')
                ->options([
                    'new'=> 'Nuevo',
                    'processing'=>'Procesando',
                    'delivered'=>'Entregado',
                    'shipped'=>'Enviado',
                    'cancelled'=>'Cancelado'
                ])
                ->sortable()
                ->searchable(),

                TextColumn::make('created_at') 
                ->dateTime()
                ->sortable()
                ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('update_at') 
                ->dateTime()
                ->sortable()
                ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                ActionGroup::make([
                    ViewAction::make(), 
                    EditAction::make(),
                    DeleteAction::make()
                ])
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

    public static function getNavigationBadge(): ?string{
        return static::getModel()::count();
    }

    public static function getNavigationBadgeColor(): string|array|null{
        return static::getModel()::count()>10 ? 'success': 'danger';
    }


    public static function getPages(): array
    {
        return [
            'index' => Pages\ListOrders::route('/'),
            'create' => Pages\CreateOrder::route('/create'),
            'view' => Pages\ViewOrder::route('/{record}'),
            'edit' => Pages\EditOrder::route('/{record}/edit'),
        ];
    }
}
