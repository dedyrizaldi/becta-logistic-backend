<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Image\Enums\Fit;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\MediaLibrary\MediaCollections\File;
use Spatie\MediaLibrary\Conversions\Manipulations;

class Project extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected $fillable = [
        'project_category_id',
        'title',
        'slug',
        'client',
        'location',
        'thumbnail', // sementara masih dipertahankan
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

    public function category(): BelongsTo
    {
        return $this->belongsTo(ProjectCategory::class);
    }

    public function registerMediaCollections(): void
    {
        $this
            ->addMediaCollection('thumbnail')
            ->singleFile()
            ->acceptsMimeTypes([
                'image/jpeg',
                'image/png',
                'image/webp',
            ]);

        $this
            ->addMediaCollection('gallery')
            ->acceptsMimeTypes([
                'image/jpeg',
                'image/png',
                'image/webp',
            ]);
    }

    public function registerMediaConversions(?Media $media = null): void
    {
        $this
            ->addMediaConversion('thumb')
            ->fit(Fit::Crop, 600, 400)
            ->performOnCollections('thumbnail');

        $this
            ->addMediaConversion('gallery_thumb')
            ->fit(Fit::Crop, 400, 300)
            ->performOnCollections('gallery');
    }
}