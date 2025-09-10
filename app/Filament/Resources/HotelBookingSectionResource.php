<?php

namespace App\Filament\Resources;

use App\Filament\Resources\HotelBookingSectionResource\Pages;
use App\Models\HotelBookingSection;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;

class HotelBookingSectionResource extends Resource
{
    protected static ?string $model = HotelBookingSection::class;

    protected static ?string $navigationIcon = 'heroicon-o-video-camera';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('title')
                ->required()
                ->maxLength(255),

            Forms\Components\Textarea::make('description')
                ->maxLength(65535)
                ->columnSpanFull(),

            Forms\Components\TextInput::make('button_text')
                ->default('BOOK NOW')
                ->maxLength(255),

            Forms\Components\TextInput::make('button_link')
                ->default('/bookform')
                ->maxLength(255),

            Forms\Components\Radio::make('video_type')
                ->options([
                    'url' => 'YouTube URL',
                    'upload' => 'Upload Video',
                ])
                ->default('url')
                ->reactive(),

            Forms\Components\TextInput::make('video_url')
                ->label('YouTube Video URL')
                ->maxLength(255)
                ->hidden(fn (callable $get) => $get('video_type') !== 'url'),

            Forms\Components\FileUpload::make('uploaded_video')
                ->label('Upload Video')
                ->directory('hotel-videos')
                ->visibility('public')
                ->hidden(fn (callable $get) => $get('video_type') !== 'upload'),

            Forms\Components\Toggle::make('is_active')
                ->required()
                ->default(true),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            TextColumn::make('title')->searchable(),
            TextColumn::make('button_text')->searchable(),
            IconColumn::make('is_active')->boolean(),
            TextColumn::make('created_at')
                ->dateTime()
                ->sortable()
                ->toggleable(isToggledHiddenByDefault: true),
            TextColumn::make('updated_at')
                ->dateTime()
                ->sortable()
                ->toggleable(isToggledHiddenByDefault: true),
        ])
        ->filters([
            Filter::make('is_active')
                ->query(fn (Builder $query) => $query->where('is_active', true)),
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
        return [];
    }

    public static function getPages(): array    
    {
        return [
            'index' => Pages\ListHotelBookingSections::route('/'),
            'create' => Pages\CreateHotelBookingSection::route('/create'),
            'edit' => Pages\EditHotelBookingSection::route('/{record}/edit'),
        ];
    }
}
