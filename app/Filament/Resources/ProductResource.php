<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Filament\Resources\ProductResource\RelationManagers;
use App\Models\Product;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\FileUpload;

use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;

use Filament\Forms\Components\Select;
use App\Models\Category;


class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-shopping-cart';

    public static function form(Form $form): Form
    {
        return $form
        ->schema([
            TextInput::make('name')
                ->label('Name')
                ->required()
                ->maxLength(255),

            Toggle::make('active')
                ->label('Is Active')
                ->default(true), 

            Forms\Components\FileUpload::make('thumbnail'),

            TextInput::make('previous_price')
                ->label('Previous Price')
                ->required()
                ->numeric(),

            TextInput::make('active_price')
                ->label('Active Price')
                ->required()
                ->numeric(),
                

            Select::make('category_id')
                ->label('Category')
                ->options(Category::all()->pluck('name', 'id')) // Fetches category names and IDs
                ->required() // Make this field required
                ->searchable() // Optional: makes the select searchable
                    ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                ->label('Name')
                ->sortable()
                ->searchable(),

                TextColumn::make('category.name') // Column for category name (using relationship)
                ->label('Category')
                ->searchable()
                ->sortable(),

                TextColumn::make('previous_price')
                    ->label('Previous Price')
                    ->money('INR') // Format the price with a currency symbol
                    ->sortable(),
                
                TextColumn::make('active_price')
                    ->label('Active Price')
                    ->money('INR') // Format the price with a currency symbol
                    ->sortable(),

                IconColumn::make('active')
                    ->label('Active')
                    ->boolean() // This automatically displays a checkmark or cross icon based on the boolean value
                    ->trueIcon('heroicon-o-check') // Optional: Custom icon for true
                    ->falseIcon('heroicon-o-x-circle'), // Optional: Custom icon for false,

                ImageColumn::make('thumbnail')
                    ->label('Image')
                    ->circular()
                    ->width(50)
                    ->height(50)
                    ->url(fn ($record) => asset('storage/uploads/images/' . $record->image)),
            ])
            ->filters([
                //
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
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}
