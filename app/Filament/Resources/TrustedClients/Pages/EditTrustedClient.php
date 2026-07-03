<?php

namespace App\Filament\Resources\TrustedClients\Pages;

use App\Filament\Resources\TrustedClients\TrustedClientResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditTrustedClient extends EditRecord
{
    protected static string $resource = TrustedClientResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
