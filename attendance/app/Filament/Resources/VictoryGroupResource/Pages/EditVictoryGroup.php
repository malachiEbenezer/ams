<?php

namespace App\Filament\Resources\VictoryGroupResource\Pages;

use App\Filament\Resources\VictoryGroupResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditVictoryGroup extends EditRecord
{
    protected static string $resource = VictoryGroupResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
