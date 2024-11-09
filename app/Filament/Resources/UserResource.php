<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;



class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                ->required()
                ->maxLength(255),
                Forms\Components\TextInput::make('email')
                ->email()
                ->required()
                ->maxLength(255)
                ->extraAttributes(['name' => 'email_'.uniqid()])
                ->autocomplete('off')
                ->rules(function ($livewire) {
                    // Apply unique rule only during creation
                    return $livewire instanceof \Filament\Resources\Pages\CreateRecord
                        ? ['unique:users,email'] // Adjust table/column as needed
                        : [];
                }),
            Forms\Components\Select::make('role')
                ->relationship('roles', 'name',)
                ->preload()
                ->required(),

            Forms\Components\TextInput::make('password')
                ->label('Password')
                ->password()
                // ->required(fn ($livewire) => $livewire instanceof CreateRecord)
                ->minLength(8)
                ->maxLength(255)
                ->revealable()
                ->autocomplete('new-password')
                // ->dehydrateStateUsing(fn ($state) => Hash::make($state))
                ->dehydrateStateUsing(fn (string $state): string => Hash::make($state))
                ->dehydrated(fn (?string $state): bool => filled($state))
                ->required(fn (string $operation): bool => $operation === 'create'),

            Forms\Components\TextInput::make('password_confirmation')
                ->label('Confirm Password')
                ->password()
                ->required(fn ($livewire) => $livewire instanceof CreateRecord)
                ->same('password')
                ->minLength(8)
                ->revealable()
                ->maxLength(255)
                ->visible(fn ($livewire) => $livewire instanceof CreateRecord),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                ->searchable(),
            Tables\Columns\TextColumn::make('email')
                ->searchable(),
            Tables\Columns\TextColumn::make('roles.0.name')
                ->label('Role')
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->label('')
                    ->icon('heroicon-o-pencil')
                    ->tooltip('Edit'),

                Tables\Actions\DeleteAction::make()
                    ->icon('heroicon-o-trash')
                    ->label('') 
                    ->tooltip('Delete'),
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
