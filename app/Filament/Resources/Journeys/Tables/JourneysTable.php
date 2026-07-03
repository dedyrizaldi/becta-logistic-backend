<?php

namespace App\Filament\Resources\Journeys\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class JourneysTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->defaultSort('sort_order')

            ->striped()

            ->columns([

                SpatieMediaLibraryImageColumn::make('image')
                    ->collection('image')
                    ->label('')
                    ->size(80),

                TextColumn::make('title')
                    ->searchable()
                    ->sortable()
                    ->weight('bold')
                    ->description(fn ($record) => $record->subtitle)
                    ->wrap(),

                TextColumn::make('button_text')
                    ->label('Button')
                    ->badge()
                    ->color('primary'),

                TextColumn::make('sort_order')
                    ->label('Sort')
                    ->badge()
                    ->sortable(),

                IconColumn::make('is_active')
                    ->label('Published')
                    ->boolean(),

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