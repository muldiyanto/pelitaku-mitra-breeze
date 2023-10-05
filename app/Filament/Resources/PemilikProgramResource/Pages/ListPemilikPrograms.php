<?php

namespace App\Filament\Resources\PemilikProgramResource\Pages;

use App\Filament\Resources\PemilikProgramResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPemilikPrograms extends ListRecords
{
    protected static string $resource = PemilikProgramResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
