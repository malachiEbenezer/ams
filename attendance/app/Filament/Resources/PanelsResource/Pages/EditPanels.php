<?php

namespace App\Filament\Resources\PanelsResource\Pages;

use App\Filament\Resources\PanelsResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPanels extends EditRecord
{
    protected static string $resource = PanelsResource::class;
    protected static ?string $title = 'Edit List';
    protected static ?string $breadcrumb = 'List';

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
