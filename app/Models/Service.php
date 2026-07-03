<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Service extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected $fillable = [

        'service_category_id',

        'title',

        'slug',

        'icon',

        'excerpt',

        'description',

        'sort_order',

        'is_featured',

        'is_active',

        'seo_title',

        'seo_description',

    ];

    protected $casts = [

        'is_featured' => 'boolean',

        'is_active' => 'boolean',

    ];

    /**
     * Category
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(ServiceCategory::class, 'service_category_id');
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
}