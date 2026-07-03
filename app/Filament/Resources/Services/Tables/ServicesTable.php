<?php

namespace App\Filament\Resources\Services\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class ServicesTable
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
                    ->square(false)
                    ->size(90),

                TextColumn::make('title')
                    ->label('Service')
                    ->searchable()
                    ->sortable()
                    ->weight('bold')
                    ->description(fn ($record) => $record->excerpt)
                    ->wrap(),

                TextColumn::make('category.name')
                    ->label('Category')
                    ->badge()
                    ->color('warning')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('sort_order')
                    ->label('Sort')
                    ->sortable()
                    ->badge(),

                IconColumn::make('is_active')
                    ->label('Published')
                    ->boolean(),

                IconColumn::make('is_featured')
                    ->label('Featured')
                    ->boolean(),

                TextColumn::make('created_at')
                    ->label('Created')
                    ->date('d M Y')
                    ->sortable(),

            ])

            ->filters([

                SelectFilter::make('service_category_id')
                    ->label('Category')
                    ->relationship('category', 'name'),

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