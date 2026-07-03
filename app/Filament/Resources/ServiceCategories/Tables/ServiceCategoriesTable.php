<?php

namespace App\Filament\Resources\ServiceCategories\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ServiceCategoriesTable
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
                    ->copyable()
                    ->badge()
                    ->color('gray'),

                TextColumn::make('services_count')
                    ->label('Services')
                    ->counts('services')
                    ->badge()
                    ->color('info'),

                TextColumn::make('sort_order')
                    ->label('Sort')
                    ->sortable(),

                IconColumn::make('is_active')
                    ->label('Published')
                    ->boolean(),

            ])

            ->filters([

                //

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