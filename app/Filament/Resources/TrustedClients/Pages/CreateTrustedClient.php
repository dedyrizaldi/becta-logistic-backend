<?php

namespace App\Filament\Resources\TrustedClients\Pages;

use App\Filament\Resources\TrustedClients\TrustedClientResource;
use Filament\Resources\Pages\CreateRecord;

class CreateTrustedClient extends CreateRecord
{
    protected static string $resource = TrustedClientResource::class;
}
