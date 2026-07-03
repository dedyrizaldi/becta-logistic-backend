<?php

namespace App\Filament\Resources\Fleets\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class FleetForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([

                /*
                |--------------------------------------------------------------------------
                | Basic Information
                |--------------------------------------------------------------------------
                */

                Section::make('🚢 Basic Information')
                    ->columns(2)
                    ->schema([

                        Select::make('fleet_category_id')
                            ->relationship('category', 'name')
                            ->searchable()
                            ->preload()
                            ->required(),

                        TextInput::make('title')
                            ->required()
                            ->live(onBlur: true)
                            ->afterStateUpdated(function ($state, callable $set) {
                                if (filled($state)) {
                                    $set('slug', Str::slug($state));
                                }
                            }),

                        TextInput::make('slug')
                            ->required()
                            ->unique(ignoreRecord: true),

                        TextInput::make('code')
                            ->label('Fleet Code')
                            ->placeholder('LCT-1200'),

                    ]),

                /*
                |--------------------------------------------------------------------------
                | Technical Specification
                |--------------------------------------------------------------------------
                */

                Section::make('📐 Technical Specification')
                    ->columns(3)
                    ->schema([

                        TextInput::make('loa')
                            ->label('LOA (m)')
                            ->numeric(),

                        TextInput::make('beam')
                            ->label('Beam (m)')
                            ->numeric(),

                        TextInput::make('depth')
                            ->label('Depth (m)')
                            ->numeric(),

                        TextInput::make('gt')
                            ->label('Gross Tonnage')
                            ->numeric(),

                        TextInput::make('cargo_capacity')
                            ->label('Cargo Capacity (Ton)')
                            ->numeric(),

                        TextInput::make('crew')
                            ->numeric(),

                        TextInput::make('engine'),

                        TextInput::make('speed')
                            ->placeholder('12 Knot'),

                        TextInput::make('built_year')
                            ->label('Built Year')
                            ->numeric()
                            ->minValue(1900)
                            ->maxValue(date('Y'))
                            ->placeholder('2012'),

                        TextInput::make('flag')
                            ->placeholder('Indonesia'),

                    ]),

                /*
                |--------------------------------------------------------------------------
                | Description
                |--------------------------------------------------------------------------
                */

                Section::make('📝 Description')
                    ->description('Content displayed on the fleet detail page.')
                    ->schema([

                        Textarea::make('excerpt')
                            ->label('Short Description')
                            ->rows(3)
                            ->columnSpanFull()
                            ->placeholder('Write a short summary about this fleet...'),

                        RichEditor::make('description')
                            ->label('Fleet Description')
                            ->columnSpanFull()
                            ->toolbarButtons([
                                'bold',
                                'italic',
                                'underline',
                                'strike',
                                'h2',
                                'h3',
                                'bulletList',
                                'orderedList',
                                'blockquote',
                                'link',
                                'undo',
                                'redo',
                            ]),

                    ]),

                /*
                |--------------------------------------------------------------------------
                | Media
                |--------------------------------------------------------------------------
                */

                Section::make('🖼 Media')
                    ->schema([

                        SpatieMediaLibraryFileUpload::make('thumbnail')
                            ->collection('thumbnail')
                            ->image()
                            ->imageEditor()
                            ->required(),

                        SpatieMediaLibraryFileUpload::make('gallery')
                            ->collection('gallery')
                            ->multiple()
                            ->reorderable()
                            ->image()
                            ->imageEditor(),

                    ]),

                /*
                |--------------------------------------------------------------------------
                | Brochure
                |--------------------------------------------------------------------------
                */

                Section::make('📄 Brochure')
                    ->schema([

                        SpatieMediaLibraryFileUpload::make('brochure')
                            ->collection('brochure')
                            ->acceptedFileTypes([
                                'application/pdf',
                            ])
                            ->downloadable()
                            ->openable(),

                    ]),

                /*
                |--------------------------------------------------------------------------
                | SEO
                |--------------------------------------------------------------------------
                */

                Section::make('📈 SEO')
                    ->schema([

                        TextInput::make('seo_title')
                            ->maxLength(60),

                        Textarea::make('seo_description')
                            ->rows(3)
                            ->maxLength(160),

                    ]),

                /*
                |--------------------------------------------------------------------------
                | Publish
                |--------------------------------------------------------------------------
                */

                Section::make('⚙ Publish')
                    ->columns(3)
                    ->schema([

                        Toggle::make('is_featured')
                            ->default(false),

                        Toggle::make('is_active')
                            ->default(true),

                        TextInput::make('sort_order')
                            ->numeric()
                            ->default(1),

                    ]),

            ]);
    }
}