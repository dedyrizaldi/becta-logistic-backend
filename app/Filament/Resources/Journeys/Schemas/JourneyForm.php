<?php

namespace App\Filament\Resources\Journeys\Schemas;

use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class JourneyForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([

                /*
                |--------------------------------------------------------------------------
                | Content
                |--------------------------------------------------------------------------
                */

                Section::make('🛣 Journey Content')
                    ->description('Content displayed in the Journey section on the homepage.')
                    ->columns(2)
                    ->schema([

                        TextInput::make('title')
                            ->required()
                            ->maxLength(255),

                        TextInput::make('subtitle')
                            ->maxLength(255),

                        Textarea::make('description')
                            ->rows(4)
                            ->columnSpanFull(),

                    ]),

                /*
                |--------------------------------------------------------------------------
                | Action Button
                |--------------------------------------------------------------------------
                */

                Section::make('🔘 Action Button')
                    ->columns(2)
                    ->schema([

                        TextInput::make('button_text')
                            ->placeholder('Read More'),

                        TextInput::make('button_url')
                            ->placeholder('/services'),

                    ]),

                /*
                |--------------------------------------------------------------------------
                | Image
                |--------------------------------------------------------------------------
                */

                Section::make('🖼 Image')
                    ->schema([

                        SpatieMediaLibraryFileUpload::make('image')
                            ->collection('image')
                            ->image()
                            ->imageEditor()
                            ->required()
                            ->helperText('Recommended size: 900 × 900 px'),

                    ]),

                /*
                |--------------------------------------------------------------------------
                | Publish
                |--------------------------------------------------------------------------
                */

                Section::make('⚙ Publish')
                    ->columns(2)
                    ->schema([

                        TextInput::make('sort_order')
                            ->numeric()
                            ->default(1)
                            ->required(),

                        Toggle::make('is_active')
                            ->label('Published')
                            ->default(true),

                    ]),

            ]);
    }
}