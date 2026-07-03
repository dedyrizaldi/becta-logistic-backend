<?php

namespace App\Filament\Resources\Projects\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class ProjectsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->defaultSort('sort_order')
            ->striped()

            ->columns([

                SpatieMediaLibraryImageColumn::make('thumbnail')
                    ->label('')
                    ->collection('thumbnail')
                    ->square(false)
                    ->size(90),

                TextColumn::make('title')
                    ->label('Project')
                    ->searchable()
                    ->sortable()
                    ->weight('bold')
                    ->description(fn ($record) => $record->location)
                    ->wrap(),

                TextColumn::make('category.name')
                    ->label('Category')
                    ->badge()
                    ->color('warning')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('client')
                    ->label('Client')
                    ->searchable()
                    ->toggleable(),

                TextColumn::make('gallery')
                    ->label('Gallery')
                    ->state(fn ($record) => $record->getMedia('gallery')->count())
                    ->badge()
                    ->color(fn ($state) => $state > 0 ? 'success' : 'gray')
                    ->formatStateUsing(fn ($state) => "{$state} Photos"),

                IconColumn::make('is_active')
                    ->label('Published')
                    ->boolean(),

                IconColumn::make('is_featured')
                    ->label('Featured')
                    ->boolean(),

                TextColumn::make('completed_at')
                    ->label('Completed')
                    ->date('d M Y')
                    ->sortable(),

                TextColumn::make('created_at')
                    ->label('Created')
                    ->dateTime('d M Y')
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('updated_at')
                    ->label('Updated')
                    ->since()
                    ->toggleable(isToggledHiddenByDefault: true),

            ])

            ->filters([

                SelectFilter::make('project_category_id')
                    ->label('Category')
                    ->relationship('category', 'name'),

                SelectFilter::make('is_active')
                    ->label('Status')
                    ->options([
                        1 => 'Published',
                        0 => 'Draft',
                    ]),

                SelectFilter::make('is_featured')
                    ->label('Featured')
                    ->options([
                        1 => 'Featured',
                        0 => 'Normal',
                    ]),

            ])

            ->recordActions([

                EditAction::make()
                    ->icon('heroicon-o-pencil-square')
                    ->label(''),

                DeleteAction::make()
                    ->icon('heroicon-o-trash')
                    ->label('')
                    ->requiresConfirmation(),

            ])

            ->toolbarActions([

                BulkActionGroup::make([

                    DeleteBulkAction::make()
                        ->requiresConfirmation(),

                ]),

            ]);
    }
}