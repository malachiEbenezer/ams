<?php

namespace App\Filament\Resources\PanelsResource\Pages;

use App\Filament\Resources\PanelsResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPanels extends ListRecords
{
    protected static string $resource = PanelsResource::class;
    protected static ?string $title = 'Lists';
    protected static ?string $breadcrumb = 'List';

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
