<?php

namespace App\Filament\Resources\PemilikProgramResource\Pages;

use App\Filament\Resources\PemilikProgramResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPemilikProgram extends EditRecord
{
    protected static string $resource = PemilikProgramResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
