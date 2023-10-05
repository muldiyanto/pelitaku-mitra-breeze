<?php

namespace App\Filament\Resources\PemilikProgramResource\Pages;

use App\Filament\Resources\PemilikProgramResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreatePemilikProgram extends CreateRecord
{
    protected static string $resource = PemilikProgramResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
