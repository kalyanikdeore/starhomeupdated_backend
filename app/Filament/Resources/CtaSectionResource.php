<?php

namespace App\Filament\Resources;

use App\Models\CtaSection;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CtaSectionResource extends Resource
{
    protected static ?string $model = CtaSection::class;

    // FIXED: Changed to a valid heroicon name
    protected static ?string $navigationIcon = 'heroicon-o-photo';

    protected static ?string $navigationGroup = 'Home Page';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('CTA Section Content')
                    ->schema([
                        Forms\Components\TextInput::make('title')
                            ->required()
                            ->maxLength(255)
                            ->label('CTA Title'),
                        Forms\Components\Textarea::make('description')
                            ->required()
                            ->maxLength(65535)
                            ->label('Description')
                            ->columnSpanFull(),
                        Forms\Components\TextInput::make('image_url')
                            ->required()
                            ->maxLength(255)
                            ->label('Image URL')
                            ->placeholder('https://example.com/image.jpg'),
                        Forms\Components\TextInput::make('phone_number')
                            ->required()
                            ->tel()
                            ->maxLength(20)
                            ->label('Phone Number'),
                        Forms\Components\Toggle::make('is_active')
                            ->required()
                            ->default(true)
                            ->label('Active Status'),
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->sortable()
                    ->searchable()
                    ->label('Title'),
                Tables\Columns\TextColumn::make('phone_number')
                    ->searchable()
                    ->label('Phone'),
                Tables\Columns\IconColumn::make('is_active')
                    ->boolean()
                    ->sortable()
                    ->label('Active'),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->label('Last Updated'),
            ])
            ->filters([
                Tables\Filters\Filter::make('is_active')
                    ->label('Active')
                    ->query(fn (Builder $query) => $query->where('is_active', true)),
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
            'index' => \App\Filament\Resources\CtaSectionResource\Pages\ListCtaSections::route('/'),
            'create' => \App\Filament\Resources\CtaSectionResource\Pages\CreateCtaSection::route('/create'),
            'edit' => \App\Filament\Resources\CtaSectionResource\Pages\EditCtaSection::route('/{record}/edit'),
        ];
    }
}