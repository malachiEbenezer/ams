<?php

namespace App\Filament\Resources\VictoryGroupResource\Pages;

use App\Filament\Resources\VictoryGroupResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListVictoryGroups extends ListRecords
{
    protected static string $resource = VictoryGroupResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
