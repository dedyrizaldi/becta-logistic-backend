<?php

namespace App\Filament\Resources\Journeys;

use App\Filament\Resources\Journeys\Pages\CreateJourney;
use App\Filament\Resources\Journeys\Pages\EditJourney;
use App\Filament\Resources\Journeys\Pages\ListJourneys;
use App\Filament\Resources\Journeys\Schemas\JourneyForm;
use App\Filament\Resources\Journeys\Tables\JourneysTable;
use App\Models\Journey;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class JourneyResource extends Resource
{
    protected static ?string $model = Journey::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedMap;

    protected static string|\UnitEnum|null $navigationGroup = 'Website Management';

    protected static ?string $navigationLabel = 'Journey';

    protected static ?int $navigationSort = 3;

    protected static ?string $recordTitleAttribute = 'title';

    public static function getNavigationBadge(): ?string
    {
        return (string) static::getModel()::count();
    }

    public static function getNavigationBadgeColor(): ?string
    {
        return 'warning';
    }

    public static function getModelLabel(): string
    {
        return 'Journey';
    }

    public static function getPluralModelLabel(): string
    {
        return 'Journey';
    }

    public static function form(Schema $schema): Schema
    {
        return JourneyForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return JourneysTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListJourneys::route('/'),
            'create' => CreateJourney::route('/create'),
            'edit' => EditJourney::route('/{record}/edit'),
        ];
    }
}