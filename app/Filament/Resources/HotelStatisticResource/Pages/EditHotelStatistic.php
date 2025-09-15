<?php

namespace App\Filament\Resources\HotelStatisticResource\Pages;

use App\Filament\Resources\HotelStatisticResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditHotelStatistic extends EditRecord
{
    protected static string $resource = HotelStatisticResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
