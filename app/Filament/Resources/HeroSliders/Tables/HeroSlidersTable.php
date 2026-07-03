<?php

namespace App\Filament\Resources\HeroSliders\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class HeroSlidersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->defaultSort('sort_order')

            ->striped()

            ->columns([

                SpatieMediaLibraryImageColumn::make('desktop')
                    ->collection('desktop')
                    ->label('')
                    ->size(90),

                TextColumn::make('title')
                    ->searchable()
                    ->sortable()
                    ->weight('bold')
                    ->description(fn ($record) => $record->subtitle)
                    ->wrap(),

                TextColumn::make('primary_button_text')
                    ->label('Primary Button')
                    ->badge()
                    ->color('primary'),

                TextColumn::make('secondary_button_text')
                    ->label('Secondary Button')
                    ->badge()
                    ->color('gray'),

                TextColumn::make('sort_order')
                    ->badge()
                    ->sortable(),

                IconColumn::make('is_active')
                    ->label('Published')
                    ->boolean(),

                TextColumn::make('created_at')
                    ->date('d M Y')
                    ->sortable(),

            ])

            ->filters([

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