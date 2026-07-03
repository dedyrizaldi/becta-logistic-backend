<?php

namespace App\Filament\Resources\TrustedClients\Pages;

use App\Filament\Resources\TrustedClients\TrustedClientResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListTrustedClients extends ListRecords
{
    protected static string $resource = TrustedClientResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
