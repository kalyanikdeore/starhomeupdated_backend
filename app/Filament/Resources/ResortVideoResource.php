<?php
// app/Filament/Resources/ResortVideoResource.php

namespace App\Filament\Resources;

use App\Filament\Resources\ResortVideoResource\Pages;
use App\Models\ResortVideo;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Storage;

class ResortVideoResource extends Resource
{
    protected static ?string $model = ResortVideo::class;

    protected static ?string $navigationIcon = 'heroicon-o-video-camera';

    protected static ?string $navigationGroup = 'About Us Page';

  public static function form(Form $form): Form
{
    return $form
        ->schema([
            Forms\Components\Section::make('Video Configuration')
                ->schema([
                    Forms\Components\Toggle::make('use_uploaded_video')
                        ->label('Use uploaded video instead of YouTube')
                        ->reactive(),
                    Forms\Components\TextInput::make('youtube_url')
                        ->label('YouTube Video URL')
                        ->placeholder('https://www.youtube.com/embed/cUXa7jfI4Po')
                        ->url()
                        ->hidden(fn ($get) => $get('use_uploaded_video'))
                        ->required(fn ($get) => !$get('use_uploaded_video')),
                    Forms\Components\FileUpload::make('uploaded_video_path') // Changed field name
                        ->label('Upload Video')
                        ->acceptedFileTypes(['video/mp4', 'video/webm', 'video/ogg'])
                        ->maxSize(51200) // 50MB
                        ->directory('resort-videos')
                        ->visibility('public')
                        ->hidden(fn ($get) => !$get('use_uploaded_video'))
                        ->required(fn ($get) => $get('use_uploaded_video'))
                        ->helperText('Max file size: 50MB. Supported formats: MP4, WebM, OGG'),
                ]),
            
                
                Forms\Components\Section::make('Video Settings')
                    ->schema([
                        Forms\Components\Toggle::make('autoplay')
                            ->default(true),
                        Forms\Components\Toggle::make('mute')
                            ->default(true),
                        Forms\Components\Toggle::make('loop')
                            ->default(true),
                    ])->columns(3),
                
                Forms\Components\Section::make('Content')
                    ->schema([
                        Forms\Components\TextInput::make('welcome_text')
                            ->default('Welcome to'),
                        Forms\Components\TextInput::make('title')
                            ->default('Star Holiday Home Resort'),
                        Forms\Components\Textarea::make('description')
                            ->required()
                            ->rows(5)
                            ->columnSpanFull(),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->searchable(),
                Tables\Columns\IconColumn::make('use_uploaded_video')
                    ->boolean()
                    ->label('Custom Video'),
                Tables\Columns\TextColumn::make('youtube_url')
                    ->label('YouTube URL')
                    ->limit(30)
                    ->toggleable(),
                Tables\Columns\TextColumn::make('uploaded_video')
                    ->label('Uploaded Video')
                    ->toggleable(),
                Tables\Columns\IconColumn::make('autoplay')
                    ->boolean(),
                Tables\Columns\IconColumn::make('mute')
                    ->boolean(),
                Tables\Columns\IconColumn::make('loop')
                    ->boolean(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
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
            'index' => Pages\ListResortVideos::route('/'),
            'create' => Pages\CreateResortVideo::route('/create'),
            'edit' => Pages\EditResortVideo::route('/{record}/edit'),
        ];
    }
    
    public static function canCreate(): bool
    {
        return ResortVideo::count() === 0;
    }
}