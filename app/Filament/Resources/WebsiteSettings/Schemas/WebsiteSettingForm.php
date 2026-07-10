<?php

namespace App\Filament\Resources\WebsiteSettings\Schemas;

use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class WebsiteSettingForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([

                /*
                |--------------------------------------------------------------------------
                | Company Information
                |--------------------------------------------------------------------------
                */

                Section::make('🌐 Company Information')
                    ->description('Basic company information displayed throughout the website.')
                    ->columns(2)
                    ->schema([

                        TextInput::make('company_name')
                            ->required()
                            ->maxLength(255)
                            ->columnSpanFull(),

                        TextInput::make('tagline')
                            ->maxLength(255)
                            ->columnSpanFull(),

                        Textarea::make('company_description')
                            ->rows(4)
                            ->columnSpanFull(),

                    ]),

                /*
                |--------------------------------------------------------------------------
                | Contact Information
                |--------------------------------------------------------------------------
                */

                Section::make('📞 Contact Information')
                    ->columns(2)
                    ->schema([

                        TextInput::make('email')
                            ->email(),

                        TextInput::make('phone'),

                        TextInput::make('mobile'),

                        TextInput::make('whatsapp'),

                        TextInput::make('fax'),

                        TextInput::make('office_hours')
                            ->columnSpanFull(),

                    ]),

                /*
                |--------------------------------------------------------------------------
                | Address
                |--------------------------------------------------------------------------
                */

                Section::make('📍 Address')
                    ->columns(2)
                    ->schema([

                        Textarea::make('address')
                            ->rows(4)
                            ->columnSpanFull(),

                        TextInput::make('latitude')
                            ->numeric(),

                        TextInput::make('longitude')
                            ->numeric(),

                        TextInput::make('google_maps')
                            ->columnSpanFull(),

                    ]),

                /*
                |--------------------------------------------------------------------------
                | Branding
                |--------------------------------------------------------------------------
                */

                Section::make('🖼 Branding')
                    ->description('Upload branding assets used across the website.')
                    ->columns(2)
                    ->schema([

                        SpatieMediaLibraryFileUpload::make('logo')
                            ->collection('logo')
                            ->label('Logo')
                            ->image()
                            ->imageEditor()
                            ->helperText('Recommended PNG with transparent background.'),

                        SpatieMediaLibraryFileUpload::make('footer_logo')
                            ->collection('footer_logo')
                            ->label('Footer Logo')
                            ->image()
                            ->imageEditor(),

                        SpatieMediaLibraryFileUpload::make('favicon')
                            ->collection('favicon')
                            ->label('Favicon')
                            ->image()
                            ->imageEditor(),

                        SpatieMediaLibraryFileUpload::make('og_image')
                            ->collection('og_image')
                            ->label('Open Graph Image')
                            ->image()
                            ->imageEditor()
                            ->helperText('Recommended size: 1200 × 630'),

                    ]),

                /*
                |--------------------------------------------------------------------------
                | Social Media
                |--------------------------------------------------------------------------
                */

                Section::make('🌍 Social Media')
                    ->columns(2)
                    ->schema([

                        TextInput::make('facebook'),

                        TextInput::make('instagram'),

                        TextInput::make('linkedin'),

                        TextInput::make('youtube'),

                        TextInput::make('tiktok'),

                        TextInput::make('twitter'),

                    ]),

                /*
                |--------------------------------------------------------------------------
                | SEO
                |--------------------------------------------------------------------------
                */

                Section::make('🔍 SEO')
                    ->schema([

                        TextInput::make('default_seo_title')
                            ->maxLength(255),

                        Textarea::make('default_seo_description')
                            ->rows(4),

                    ]),

                /*
                |--------------------------------------------------------------------------
                | Footer
                |--------------------------------------------------------------------------
                */

                Section::make('📝 Footer')
                    ->schema([

                        Textarea::make('footer_text')
                            ->rows(4),

                        TextInput::make('copyright'),

                    ]),

            ]);
    }
}