<?php

namespace App\Filament\Resources\TrustedClients\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class TrustedClientsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->defaultSort('sort_order')

            ->striped()

            ->columns([

                SpatieMediaLibraryImageColumn::make('logo')
                    ->collection('logo')
                    ->label('')
                    ->size(70),

                TextColumn::make('name')
                    ->label('Company')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),

                TextColumn::make('website')
                    ->searchable()
                    ->copyable()
                    ->color('primary')
                    ->limit(40),

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