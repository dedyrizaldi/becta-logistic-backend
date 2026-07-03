<?php

namespace App\Filament\Resources\FleetCategories;

use App\Filament\Resources\FleetCategories\Pages\CreateFleetCategory;
use App\Filament\Resources\FleetCategories\Pages\EditFleetCategory;
use App\Filament\Resources\FleetCategories\Pages\ListFleetCategories;
use App\Filament\Resources\FleetCategories\Schemas\FleetCategoryForm;
use App\Filament\Resources\FleetCategories\Tables\FleetCategoriesTable;
use App\Models\FleetCategory;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class FleetCategoryResource extends Resource
{
    protected static ?string $model = FleetCategory::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedTag;

    protected static string|\UnitEnum|null $navigationGroup = 'Content Management';

    protected static ?string $navigationLabel = 'Fleet Categories';

    protected static ?int $navigationSort = 5;

    protected static ?string $recordTitleAttribute = 'name';

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
        return 'Fleet Category';
    }

    public static function getPluralModelLabel(): string
    {
        return 'Fleet Categories';
    }

    public static function form(Schema $schema): Schema
    {
        return FleetCategoryForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return FleetCategoriesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListFleetCategories::route('/'),
            'create' => CreateFleetCategory::route('/create'),
            'edit' => EditFleetCategory::route('/{record}/edit'),
        ];
    }
}