<?php

namespace App\Filament\Resources\TrustedClients\Schemas;

use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class TrustedClientForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([

                /*
                |--------------------------------------------------------------------------
                | Client Information
                |--------------------------------------------------------------------------
                */

                Section::make('🏢 Client Information')
                    ->description('Trusted client information displayed on the homepage.')
                    ->columns(2)
                    ->schema([

                        TextInput::make('name')
                            ->label('Company Name')
                            ->required()
                            ->maxLength(255),

                        TextInput::make('website')
                            ->label('Website')
                            ->url()
                            ->placeholder('https://example.com'),

                    ]),

                /*
                |--------------------------------------------------------------------------
                | Logo
                |--------------------------------------------------------------------------
                */

                Section::make('🖼 Company Logo')
                    ->schema([

                        SpatieMediaLibraryFileUpload::make('logo')
                            ->collection('logo')
                            ->image()
                            ->imageEditor()
                            ->required()
                            ->helperText('Recommended: PNG with transparent background.'),

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