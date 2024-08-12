<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ReporteUsuariosResource\Pages;
use App\Filament\Resources\ReporteUsuariosResource\RelationManagers;
use App\Models\User; // Usar el modelo User en lugar de ReporteUsuarios
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;

class ReporteUsuariosResource extends Resource
{
    protected static ?string $model = User::class; // Cambia el modelo a User
    protected static ?string $navigationGroup = 'Reportes';
    protected static ?string $navigationLabel = 'Reporte de Usuarios';
    protected static ?string $navigationIcon = 'heroicon-o-user-group'; // Cambia el ícono si es necesario

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // Agrega los campos que necesites en el formulario
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Nombre')
                    ->searchable(),

                TextColumn::make('email')
                    ->label('Correo Electrónico')
                    ->searchable(),

                TextColumn::make('email_verified_at')
                    ->label('Verificación de Correo Electrónico')
                    ->dateTime()
                    ->sortable(),

                TextColumn::make('created_at')
                    ->label('Creado en')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                // Agrega filtros si es necesario
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\ViewAction::make(),
                Tables\Actions\DeleteAction::make(),

            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->contentFooter(function () {
                $totalUsers = User::count();
                return view('filament.tables.total-users', compact('totalUsers'));
            });
    }

    public static function getRelations(): array
    {
        return [
            // Define las relaciones si es necesario
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListReporteUsuarios::route('/'),
            'create' => Pages\CreateReporteUsuarios::route('/create'),
            'edit' => Pages\EditReporteUsuarios::route('/{record}/edit'),
        ];
    }
}
