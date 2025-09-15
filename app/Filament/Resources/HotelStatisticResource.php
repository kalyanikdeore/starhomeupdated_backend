<?php

namespace App\Filament\Resources;

use App\Filament\Resources\HotelStatisticResource\Pages;
use App\Filament\Resources\HotelStatisticResource\RelationManagers;
use App\Models\HotelStatistic;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class HotelStatisticResource extends Resource
{
    protected static ?string $model = HotelStatistic::class;

    protected static ?string $navigationIcon = 'heroicon-o-chart-bar';

 protected static ?string $navigationGroup = 'Home Page';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('label')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('number')
                    ->required()
                    ->numeric()
                    ->step(0.01),
                Forms\Components\TextInput::make('suffix')
                    ->maxLength(10),
                Forms\Components\TextInput::make('decimals')
                    ->numeric()
                    ->default(0)
                    ->minValue(0)
                    ->maxValue(3),
                Forms\Components\TextInput::make('sort_order')
                    ->numeric()
                    ->default(0),
                Forms\Components\Toggle::make('is_active')
                    ->default(true),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('label')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('number')
                    ->sortable(),
                Tables\Columns\TextColumn::make('suffix'),
                Tables\Columns\TextColumn::make('decimals'),
                Tables\Columns\TextColumn::make('sort_order')
                    ->sortable(),
                Tables\Columns\IconColumn::make('is_active')
                    ->boolean()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\Filter::make('is_active')
                    ->query(fn ($query) => $query->where('is_active', true))
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('sort_order', 'asc');
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
            'index' => Pages\ListHotelStatistics::route('/'),
            'create' => Pages\CreateHotelStatistic::route('/create'),
            'edit' => Pages\EditHotelStatistic::route('/{record}/edit'),
        ];
    }
}