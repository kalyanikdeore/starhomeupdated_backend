<?php

namespace App\Filament\Resources\HotelStatisticResource\Pages;

use App\Filament\Resources\HotelStatisticResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListHotelStatistics extends ListRecords
{
    protected static string $resource = HotelStatisticResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
