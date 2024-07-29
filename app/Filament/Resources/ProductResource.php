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
                    Section::make('Product Information')->schema([
                        TextInput::make('name') // Cambié 'Nombre' por 'name'
                        ->label('Name')
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
                        ->columnSpanFull()
                        ->fileAttachmentsDirectory('products')
    
                    ])->columns(2),
    
                    Section::make('Images')->schema([
                        FileUpload::make('images') // Cambié 'Imágenes' por 'images'
                        ->multiple()
                        ->directory('products')
                        ->maxFiles(5)
                        ->reorderable()
                    ])
                ])->columnSpan(2),
                Group::make()->schema([
                    Section::make('Price')->schema([
                        TextInput::make('price') // Cambié 'precio' por 'price'
                        ->numeric()
                        ->required()
                        ->prefix('USD')
                    ]),
                    Section::make('School')->schema([
                        Select::make('category_id')
                            ->required()
                            ->searchable()
                            ->preload()
                            ->relationship('category', 'name'),
                    ]),
                    Section::make('Status')->schema([
                        Toggle::make('in_stock') // Cambié 'en_stock' por 'in_stock'
                        ->required()
                        ->default('true'),
                        Toggle::make('is_active') // Cambié 'está_activo' por 'is_active'
                        ->required()
                        ->default('true'),
                        Toggle::make('is_featured') // Cambié 'es_favorito' por 'is_featured'
                        ->required()
                        ->default('true'),
                        Toggle::make('on_sale') // Cambié 'vendido' por 'on_sale'
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
                ->searchable(),

                TextColumn::make('category.name')
                ->sortable(),
                TextColumn::make('price')
                ->money('USD')
                ->sortable(),
                IconColumn::make('is_featured')
                ->boolean(),
                IconColumn::make('on_sale')
                ->boolean(),
                IconColumn::make('in_stock')
                ->boolean(),
                IconColumn::make('is_active')
                ->boolean(),

                TextColumn::make('created_at')
                ->dateTime()
                ->sortable()
                ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
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