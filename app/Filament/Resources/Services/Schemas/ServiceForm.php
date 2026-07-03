<?php

namespace App\Filament\Resources\Services\Schemas;

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

class ServiceForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([

                Section::make('📝 Service Information')
                    ->description('Basic information about the service.')
                    ->columns(2)
                    ->schema([

                        Select::make('service_category_id')
                            ->label('Service Category')
                            ->relationship('category', 'name')
                            ->searchable()
                            ->preload()
                            ->required(),

                        TextInput::make('title')
                            ->label('Service Title')
                            ->placeholder('Tank Cleaning')
                            ->required()
                            ->live(onBlur: true)
                            ->afterStateUpdated(function ($state, callable $set) {
                                if (filled($state)) {
                                    $set('slug', Str::slug($state));
                                }
                            }),

                        TextInput::make('slug')
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->helperText('This slug will be used in the website URL.'),

                        TextInput::make('icon')
                            ->placeholder('heroicon-o-wrench-screwdriver')
                            ->helperText('Optional Heroicon name or custom icon class.'),

                    ]),

                Section::make('📄 Content')
                    ->description('Content displayed on the website.')
                    ->schema([

                        Textarea::make('excerpt')
                            ->label('Short Description')
                            ->rows(3)
                            ->columnSpanFull()
                            ->placeholder('Write a short summary about this service...'),

                        RichEditor::make('description')
                            ->label('Service Description')
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

                Section::make('🖼 Media')
                    ->description('Upload service thumbnail and gallery.')
                    ->schema([

                        SpatieMediaLibraryFileUpload::make('thumbnail')
                            ->collection('thumbnail')
                            ->label('Thumbnail')
                            ->image()
                            ->imageEditor()
                            ->imagePreviewHeight('220')
                            ->acceptedFileTypes([
                                'image/jpeg',
                                'image/png',
                                'image/webp',
                            ])
                            ->maxSize(5120)
                            ->downloadable()
                            ->openable()
                            ->required(),

                        SpatieMediaLibraryFileUpload::make('gallery')
                            ->collection('gallery')
                            ->label('Gallery')
                            ->multiple()
                            ->reorderable()
                            ->image()
                            ->imageEditor()
                            ->imagePreviewHeight('170')
                            ->acceptedFileTypes([
                                'image/jpeg',
                                'image/png',
                                'image/webp',
                            ])
                            ->maxSize(5120)
                            ->downloadable()
                            ->openable(),

                    ]),

                Section::make('📈 SEO')
                    ->description('Search engine optimization.')
                    ->schema([

                        TextInput::make('seo_title')
                            ->label('SEO Title')
                            ->maxLength(60)
                            ->placeholder('Maximum 60 characters'),

                        Textarea::make('seo_description')
                            ->label('SEO Description')
                            ->rows(3)
                            ->maxLength(160)
                            ->placeholder('Maximum 160 characters'),

                    ]),

                Section::make('⚙ Publish')
                    ->columns(3)
                    ->schema([

                        Toggle::make('is_featured')
                            ->label('Featured')
                            ->default(false),

                        Toggle::make('is_active')
                            ->label('Published')
                            ->default(true),

                        TextInput::make('sort_order')
                            ->label('Sort Order')
                            ->numeric()
                            ->default(1)
                            ->required(),

                    ]),

            ]);
    }
}