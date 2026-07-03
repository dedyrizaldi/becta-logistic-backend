<?php

namespace App\Filament\Resources\TrustedClients;

use App\Filament\Resources\TrustedClients\Pages\CreateTrustedClient;
use App\Filament\Resources\TrustedClients\Pages\EditTrustedClient;
use App\Filament\Resources\TrustedClients\Pages\ListTrustedClients;
use App\Filament\Resources\TrustedClients\Schemas\TrustedClientForm;
use App\Filament\Resources\TrustedClients\Tables\TrustedClientsTable;
use App\Models\TrustedClient;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class TrustedClientResource extends Resource
{
    protected static ?string $model = TrustedClient::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Schema $schema): Schema
    {
        return TrustedClientForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return TrustedClientsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListTrustedClients::route('/'),
            'create' => CreateTrustedClient::route('/create'),
            'edit' => EditTrustedClient::route('/{record}/edit'),
        ];
    }
}
