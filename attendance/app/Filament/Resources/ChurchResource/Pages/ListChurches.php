<?php

namespace App\Filament\Resources\ChurchResource\Pages;

use App\Filament\Resources\ChurchResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListChurches extends ListRecords
{
    protected static string $resource = ChurchResource::class;

    protected static ?string $title = 'Member Profile';

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->label('New Profile'),
        ];
    }
}
