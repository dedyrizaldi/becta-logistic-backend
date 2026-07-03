<?php

namespace App\Filament\Resources\Fleets\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class FleetsTable
{
    public static function configure(Table $table): Table
    {
        return $table

            ->defaultSort('sort_order')

            ->striped()

            ->columns([

                SpatieMediaLibraryImageColumn::make('thumbnail')
                    ->collection('thumbnail')
                    ->label('')
                    ->size(90),

                TextColumn::make('title')
                    ->label('Fleet')
                    ->searchable()
                    ->sortable()
                    ->weight('bold')
                    ->description(fn ($record) => $record->excerpt)
                    ->wrap(),

                TextColumn::make('category.name')
                    ->label('Category')
                    ->badge()
                    ->color('primary')
                    ->sortable(),

                TextColumn::make('code')
                    ->badge()
                    ->color('gray'),

                TextColumn::make('cargo_capacity')
                    ->label('Capacity')
                    ->suffix(' Ton')
                    ->sortable(),

                TextColumn::make('gt')
                    ->label('GT')
                    ->sortable(),

                TextColumn::make('sort_order')
                    ->badge(),

                IconColumn::make('is_featured')
                    ->label('Featured')
                    ->boolean(),

                IconColumn::make('is_active')
                    ->label('Published')
                    ->boolean(),

                TextColumn::make('created_at')
                    ->date('d M Y')
                    ->sortable(),

            ])

            ->filters([

                SelectFilter::make('fleet_category_id')
                    ->relationship('category', 'name'),

                SelectFilter::make('is_active')
                    ->options([
                        1 => 'Published',
                        0 => 'Draft',
                    ]),

            ])

            ->recordActions([

                EditAction::make(),

                DeleteAction::make(),

            ])

            ->toolbarActions([

                BulkActionGroup::make([

                    DeleteBulkAction::make(),

                ]),

            ]);
    }
}