<?php

namespace App\Filament\Resources\Projects\Pages;

use App\Filament\Resources\Projects\ProjectResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;
use App\Services\HomepageService;

class EditProject extends EditRecord
{
    protected static string $resource = ProjectResource::class;

     protected function afterSave(): void
    {
        app(HomepageService::class)->clearHomepageCache();
    }
    
    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make()
             ->after(function () {
                    app(HomepageService::class)
                        ->clearHomepageCache();
                }),
        ];
    }


}