<?php

namespace App\Filament\Resources\HeroSliders\Schemas;

use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class HeroSliderForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([

                /*
                |--------------------------------------------------------------------------
                | Hero Content
                |--------------------------------------------------------------------------
                */

                Section::make('🖥 Hero Content')
                    ->description('Main content displayed on the homepage hero slider.')
                    ->columns(2)
                    ->schema([

                        TextInput::make('title')
                            ->required()
                            ->maxLength(255)
                            ->columnSpanFull(),

                        TextInput::make('subtitle')
                            ->maxLength(255),

                        TextInput::make('sort_order')
                            ->numeric()
                            ->default(1)
                            ->required(),

                        Textarea::make('description')
                            ->rows(4)
                            ->columnSpanFull(),

                    ]),

                /*
                |--------------------------------------------------------------------------
                | Primary Button
                |--------------------------------------------------------------------------
                */

                Section::make('🔘 Primary Button')
                    ->columns(2)
                    ->schema([

                        TextInput::make('primary_button_text')
                            ->placeholder('Get Quote'),

                        TextInput::make('primary_button_url')
                            ->placeholder('/contact'),

                    ]),

                /*
                |--------------------------------------------------------------------------
                | Secondary Button
                |--------------------------------------------------------------------------
                */

                Section::make('🔘 Secondary Button')
                    ->columns(2)
                    ->schema([

                        TextInput::make('secondary_button_text')
                            ->placeholder('Learn More'),

                        TextInput::make('secondary_button_url')
                            ->placeholder('/about'),

                    ]),

                /*
                |--------------------------------------------------------------------------
                | Images
                |--------------------------------------------------------------------------
                */

                Section::make('🖼 Images')
                    ->description('Upload separate images for desktop and mobile.')
                    ->columns(2)
                    ->schema([

                        SpatieMediaLibraryFileUpload::make('desktop')
                            ->collection('desktop')
                            ->label('Desktop Image')
                            ->image()
                            ->imageEditor()
                            ->required()
                            ->helperText('Recommended size: 1920 × 1080'),

                        SpatieMediaLibraryFileUpload::make('mobile')
                            ->collection('mobile')
                            ->label('Mobile Image')
                            ->image()
                            ->imageEditor()
                            ->required()
                            ->helperText('Recommended size: 1080 × 1350'),

                    ]),

                /*
                |--------------------------------------------------------------------------
                | Publish
                |--------------------------------------------------------------------------
                */

                Section::make('⚙ Publish')
                    ->schema([

                        Toggle::make('is_active')
                            ->label('Active')
                            ->default(true),

                    ]),

            ]);
    }
}