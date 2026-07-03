<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Project extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected $fillable = [
        'project_category_id',
        'title',
        'slug',
        'client',
        'location',
        'excerpt',
        'description',
        'completed_at',
        'sort_order',
        'is_featured',
        'is_active',
        'seo_title',
        'seo_description',
    ];

    protected function casts(): array
    {
        return [
            'completed_at' => 'date',
            'is_featured' => 'boolean',
            'is_active' => 'boolean',
        ];
    }

    /**
     * Category Relation
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(
            ProjectCategory::class,
            'project_category_id',
            'id'
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
            ->addMediaCollection('gallery');
    }

    /**
     * Media Conversions
     */
    public function registerMediaConversions(?Media $media = null): void
    {
        $this
            ->addMediaConversion('thumb')
            ->width(500)
            ->height(350)
            ->sharpen(10)
            ->performOnCollections('thumbnail');

        $this
            ->addMediaConversion('gallery_thumb')
            ->width(600)
            ->height(400)
            ->sharpen(10)
            ->performOnCollections('gallery');
    }
}