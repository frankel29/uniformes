<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Filament\Resources\ProductResource\RelationManagers;
use App\Models\Product; //Product
use Filament\Forms; //Forms
use Filament\Forms\Form; //Form
use Filament\Forms\set; //Set
use Filament\Forms\Components\Group; //Group
use Filament\Forms\Components\Section; //Section
use Filament\Forms\Components\TextInput; //TextInput
use Filament\Forms\Components\MarkdownEditor; //MarkdownEditor
use Filament\Forms\Components\FileUpload; //FileUpload
use Filament\Forms\Components\Select; //Select
use Filament\Forms\Components\Toggle; //Toogle
use Filament\Resources\Resource; // Resource
use Filament\Tables; //Tables
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Str;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\DeleteAction;



class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?int $navigationSort = 3;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Group::make()->schema([
                    Section::make('Informacion del Producto')->schema([
                        TextInput::make('name') // Cambié 'Nombre' por 'name'
                        ->label('Nombre')
                        ->required()
                        ->maxLength(255)
                        ->live(onBlur: true)
                        ->afterStateUpdated(function(string $operation, $state, Set $set){
                            if($operation !== 'create' ){
                                return;
                            }
                            $set('slug', Str::slug($state));
                        } ),
    
                        TextInput::make('slug')
                        ->required()
                        ->maxLength(255)
                        ->disabled()
                        ->dehydrated()
                        ->unique(Product::class, 'slug', ignoreRecord: true),
    
                        MarkdownEditor::make('description') // Cambié 'Descripción' por 'description'
                        ->label('Descripción')
                        ->columnSpanFull()
                        ->fileAttachmentsDirectory('products')
    
                    ])->columns(2),
    
                    Section::make('Images')->schema([
                        FileUpload::make('images') // Cambié 'Imágenes' por 'images'
                        ->label('Imagen')
                        ->multiple()
                        ->directory('products')
                        ->maxFiles(5)
                        ->reorderable()
                    ])
                ])->columnSpan(2),
                Group::make()->schema([
                    Section::make('Price')->schema([
                        TextInput::make('price') // Cambié 'precio' por 'price'
                        ->label('Precio')
                        ->numeric()
                        ->required()
                        ->minValue(0) // Valor mínimo permitido
                        ->maxValue(10000) // Valor máximo permitido
                        ->rules(['regex:/^\d+(\.\d{1,2})?$/', 'min:0', 'max:10000']) // Reglas de validación para solo números positivos y decimales
                        ->prefix('USD')
                        
                    ]),
                    Section::make('School')->schema([
                        Select::make('category_id')
                            ->label('Colegio')
                            ->required()
                            ->searchable()
                            ->preload()
                            ->relationship('category', 'name'),
                    ]),
                    Section::make('Status')->schema([
                        Toggle::make('in_stock') // Cambié 'en_stock' por 'in_stock'
                        ->label('En Stock')
                        ->required()
                        ->default('true'),
                        Toggle::make('is_active')
                        ->label('Esta Activo') // Cambié 'está_activo' por 'is_active'
                        ->required()
                        ->default('true'),
                        Toggle::make('is_featured') 
                        ->label('Es Favorito')// Cambié 'es_favorito' por 'is_featured'
                        ->required()
                        ->default('true'),
                        Toggle::make('on_sale')
                        ->label('Vendido') // Cambié 'vendido' por 'on_sale'
                        ->required()
                        ->default('true'),
                    ])                    
                ])->columnSpan(1)
            ])->columns(3);
    }
    

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                ->label('Nombre')
                ->searchable(),

                TextColumn::make('category.name')
                ->label('Colegio')
                ->sortable(),
                TextColumn::make('price')
                ->label('Precio')
                ->money('USD')
                ->sortable(),
                IconColumn::make('is_featured')
                ->label('Es Favorito')
                ->boolean(),
                IconColumn::make('on_sale')
                ->label('Vendido')
                ->boolean(),
                IconColumn::make('in_stock')
                ->label('En Stock')
                ->boolean(),
                IconColumn::make('is_active')
                ->label('Esta Activo')
                ->boolean(),

                TextColumn::make('created_at')
                ->label('Creado en')
                ->dateTime()
                ->sortable()
                ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                ->label('Editado en')
                ->dateTime()
                ->sortable()
                ->toggleable(isToggledHiddenByDefault: true)

            ])
            ->filters([
                SelectFilter::make('category')
                ->relationship('category', 'name')
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

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}