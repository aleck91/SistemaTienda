<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductoResource\Pages;
use App\Models\Producto;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Actions;
use Filament\Tables\Filters\Filter;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Section;


class ProductoResource extends Resource
{
    protected static ?string $model = Producto::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nombre')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Textarea::make('descripcion')
                    ->label('Descripción')
                    ->maxLength(65535),
                Forms\Components\TextInput::make('cantidad')
                    ->numeric()
                    ->required(),
                Forms\Components\TextInput::make('precio')
                    ->numeric()
                    ->required()
                    ->label('Precio')
                    ->prefix('$'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->label('ID')->sortable(),
                TextColumn::make('nombre')->label('Nombre')->sortable()->searchable(),
                TextColumn::make('descripcion')->label('Descripción')->limit(50),
                TextColumn::make('cantidad')->label('Cantidad')->sortable(),
                TextColumn::make('precio')->label('Precio')->money('USD')->sortable(),
                TextColumn::make('created_at')->label('Creado el')->dateTime(),
            ])
            ->filters([
                // Filtro por rango de precio
                Filter::make('precio')
                    ->form([
                        Section::make('Rango de Precio')
                            ->schema([
                                Forms\Components\TextInput::make('min_precio')->numeric()->label('Precio mínimo'),
                                Forms\Components\TextInput::make('max_precio')->numeric()->label('Precio máximo'),
                            ])
                    ])
                    ->query(function ($query, $data) {
                        return $query->when($data['min_precio'] ?? null, function ($query, $min_precio) {
                            $query->where('precio', '>=', $min_precio);
                        })->when($data['max_precio'] ?? null, function ($query, $max_precio) {
                            $query->where('precio', '<=', $max_precio);
                        });
                    })
                    ->label('Filtrar por precio'),

                // Filtro por rango de cantidad
                Filter::make('cantidad')
                    ->form([
                        Section::make('Rango de Cantidad')
                            ->schema([
                                Forms\Components\TextInput::make('min_cantidad')->numeric()->label('Cantidad mínima'),
                                Forms\Components\TextInput::make('max_cantidad')->numeric()->label('Cantidad máxima'),
                            ])
                    ])
                    ->query(function ($query, $data) {
                        return $query->when($data['min_cantidad'] ?? null, function ($query, $min_cantidad) {
                            $query->where('cantidad', '>=', $min_cantidad);
                        })->when($data['max_cantidad'] ?? null, function ($query, $max_cantidad) {
                            $query->where('cantidad', '<=', $max_cantidad);
                        });
                    })
                    ->label('Filtrar por cantidad'),

                // Filtro por disponibilidad (stock bajo/agotado)
                Filter::make('disponibilidad')
                    ->form([
                        Select::make('disponibilidad')
                            ->label('Disponibilidad')
                            ->options([
                                'bajo_stock' => 'Bajo stock',
                                'agotado' => 'Agotado',
                            ])
                            ->searchable(),
                    ])
                    ->query(function ($query, $data) {
                        return $query->when($data['disponibilidad'] == 'bajo_stock', function ($query) {
                            $query->where('cantidad', '<=', 5); // Stock bajo
                        })
                        ->when($data['disponibilidad'] == 'agotado', function ($query) {
                            $query->where('cantidad', '=', 0); // Agotado
                        });
                    })
                    ->label('Filtrar por disponibilidad'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListProductos::route('/'),
            'create' => Pages\CreateProducto::route('/create'),
            'edit' => Pages\EditProducto::route('/{record}/edit'),
        ];
    }
}
