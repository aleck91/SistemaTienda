<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UsuarioResource\Pages;
use App\Filament\Resources\UsuarioResource\RelationManagers;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Gate;


class UsuarioResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function authorization() 
    {
         return [ 
            'view' => fn () => Gate::allows('view', User::class), 
        ];
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label('Nombre de Usuario')
                    ->maxLength(255)
                    ->required()
                    ->placeholder('Ingresa el nombre completo'),

                Forms\Components\TextInput::make('email')
                    ->label('Email')
                    ->email()
                    ->maxLength(50)
                    ->required()
                    ->placeholder('Ingresa el nombre de usuario'),

                Forms\Components\Select::make('roles')
                    ->label('Rol')
                    ->relationship('roles', 'name') // Usa la relación definida en el modelo
                    ->multiple() // Permitir varios roles
                    ->searchable() // Permitir búsqueda en la lista
                    ->required()
                    ->placeholder('Selecciona un rol'),

                Forms\Components\TextInput::make('password')
                    ->label('Contraseña')
                    ->password() // Campo de tipo contraseña
                    ->maxLength(255)
                    ->dehydrateStateUsing(fn ($state) => $state ? Hash::make($state) : null) // Encripta solo si se ingresa una nueva contraseña
                    ->dehydrated(fn ($state) => filled($state)) // Evita que se pase el campo si está vacío
                    ->placeholder('Deja vacío para mantener la contraseña actual'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id'),
                Tables\Columns\TextColumn::make('name')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('created_at')->date(),
                Tables\Columns\TextColumn::make('roles.name')->label('Roles')->sortable()->searchable(),
                //
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageUsuarios::route('/'),
        ];
    }

}
