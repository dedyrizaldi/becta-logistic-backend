<?php

namespace App\Filament\Resources\Projects\Schemas;

use App\Models\ProjectCategory;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class ProjectForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([

                Select::make('project_category_id')
                    ->label('Project Category')
                    ->options(
                        ProjectCategory::query()
                            ->where('is_active', true)
                            ->pluck('name', 'id')
                    )
                    ->searchable()
                    ->preload()
                    ->required(),

                TextInput::make('title')
                    ->required()
                    ->live(onBlur: true)
                    ->afterStateUpdated(fn ($state, $set) => $set('slug', Str::slug($state))),

                TextInput::make('slug')
                    ->required(),

                TextInput::make('client'),

                TextInput::make('location'),

                TextInput::make('thumbnail'),

                Textarea::make('excerpt')
                    ->rows(3),

                Textarea::make('description')
                    ->rows(8),

                DatePicker::make('completed_at'),

                TextInput::make('sort_order')
                    ->numeric()
                    ->default(1),

                Toggle::make('is_featured')
                    ->default(false),

                Toggle::make('is_active')
                    ->default(true),

                TextInput::make('seo_title'),

                Textarea::make('seo_description')
                    ->rows(3),

            ]);
    }
}