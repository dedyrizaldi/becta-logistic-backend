<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class News extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected $fillable = [
        'news_category_id',
        'title',
        'slug',
        'author',
        'reading_time',
        'views',
        'tags',
        'excerpt',
        'description',
        'published_at',
        'sort_order',
        'is_featured',
        'is_active',
        'seo_title',
        'seo_description',
        'source',
    ];

    protected $casts = [
        'published_at' => 'date',
        'is_featured' => 'boolean',
        'is_active' => 'boolean',
        'views' => 'integer',
        'tags' => 'array',
    ];

    /**
     * Category
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(
            NewsCategory::class,
            'news_category_id'
        );
    }

    /**
     * Media Collections
     */
    public function registerMediaCollections(): void
    {
        $this
            ->addMediaCollection('thumbnail')
            ->singleFile();

        $this
            ->addMediaCollection('cover')
            ->singleFile();

        $this
            ->addMediaCollection('gallery');
    }
}