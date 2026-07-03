<?php

namespace App\Filament\Resources\FleetCategories\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class FleetCategoriesTable
{
    public static function configure(Table $table): Table
    {
        return $table

            ->defaultSort('sort_order')

            ->striped()

            ->columns([

                TextColumn::make('name')
                    ->label('Category')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),

                TextColumn::make('slug')
                    ->searchable()
                    ->copyable()
                    ->color('gray'),

                TextColumn::make('description')
                    ->limit(60)
                    ->wrap(),

                TextColumn::make('sort_order')
                    ->label('Sort')
                    ->badge()
                    ->sortable(),

                IconColumn::make('is_active')
                    ->label('Published')
                    ->boolean(),

                TextColumn::make('fleets_count')
                    ->label('Fleet')
                    ->counts('fleets')
                    ->badge()
                    ->color('primary'),

                TextColumn::make('created_at')
                    ->label('Created')
                    ->date('d M Y')
                    ->sortable(),

            ])

            ->filters([

                SelectFilter::make('is_active')
                    ->label('Status')
                    ->options([
                        1 => 'Published',
                        0 => 'Draft',
                    ]),

            ])

            ->recordActions([

                EditAction::make()
                    ->label('')
                    ->icon('heroicon-o-pencil-square'),

                DeleteAction::make()
                    ->label('')
                    ->icon('heroicon-o-trash')
                    ->color('danger'),

            ])

            ->toolbarActions([

                BulkActionGroup::make([

                    DeleteBulkAction::make(),

                ]),

            ]);
    }
}