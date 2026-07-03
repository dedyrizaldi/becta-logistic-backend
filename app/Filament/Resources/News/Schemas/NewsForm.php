<?php

namespace App\Filament\Resources\News\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class NewsForm
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

                Section::make('📰 Basic Information')
                    ->description('Main information of the news article.')
                    ->columns(2)
                    ->schema([

                        Select::make('news_category_id')
                            ->label('Category')
                            ->relationship('category', 'name')
                            ->searchable()
                            ->preload()
                            ->required(),

                        TextInput::make('title')
                            ->required()
                            ->maxLength(255)
                            ->live(onBlur: true)
                            ->afterStateUpdated(function ($state, callable $set) {
                                if (filled($state)) {
                                    $set('slug', Str::slug($state));
                                }
                            }),

                        TextInput::make('slug')
                            ->required()
                            ->unique(ignoreRecord: true),

                        TextInput::make('author')
                            ->default('Becta Logistics')
                            ->required(),

                        TextInput::make('source')
                            ->placeholder('Internal / Press Release'),

                        TextInput::make('reading_time')
                            ->placeholder('5 min read'),

                        DatePicker::make('published_at')
                            ->native(false)
                            ->default(now()),

                    ]),

                /*
                |--------------------------------------------------------------------------
                | Tags
                |--------------------------------------------------------------------------
                */

                Section::make('🏷 Tags')
                    ->schema([

                        TagsInput::make('tags')
                            ->placeholder('Press Enter to add tag')
                            ->columnSpanFull(),

                    ]),

                /*
                |--------------------------------------------------------------------------
                | Article
                |--------------------------------------------------------------------------
                */

                Section::make('📝 Article')
                    ->schema([

                        Textarea::make('excerpt')
                            ->label('Short Description')
                            ->rows(3)
                            ->required(),

                        RichEditor::make('description')
                            ->label('Article Content')
                            ->columnSpanFull()
                            ->required(),

                    ]),

                /*
                |--------------------------------------------------------------------------
                | Media
                |--------------------------------------------------------------------------
                */

                Section::make('🖼 Media')
                    ->columns(2)
                    ->schema([

                        SpatieMediaLibraryFileUpload::make('thumbnail')
                            ->collection('thumbnail')
                            ->image()
                            ->imageEditor()
                            ->required(),

                        SpatieMediaLibraryFileUpload::make('cover')
                            ->collection('cover')
                            ->image()
                            ->imageEditor()
                            ->required(),

                        SpatieMediaLibraryFileUpload::make('gallery')
                            ->collection('gallery')
                            ->multiple()
                            ->reorderable()
                            ->image()
                            ->imageEditor()
                            ->columnSpanFull(),

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
                    ->columns(4)
                    ->schema([

                        Toggle::make('is_featured')
                            ->label('Featured')
                            ->default(false),

                        Toggle::make('is_active')
                            ->label('Published')
                            ->default(true),

                        TextInput::make('sort_order')
                            ->numeric()
                            ->default(1),

                        TextInput::make('views')
                            ->numeric()
                            ->default(0)
                            ->disabled()
                            ->dehydrated(),

                    ]),

            ]);
    }
}