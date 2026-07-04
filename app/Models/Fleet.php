<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Builder;

class Fleet extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected $fillable = [

        'fleet_category_id',

        'title',

        'slug',

        'code',

        'loa',

        'beam',

        'depth',

        'gt',

        'cargo_capacity',

        'engine',

        'speed',

        'crew',

        'built_year',

        'flag',

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

        'loa' => 'decimal:2',

        'beam' => 'decimal:2',

        'depth' => 'decimal:2',

    ];

    /**
     * Fleet Category
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(FleetCategory::class, 'fleet_category_id');
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

        $this
            ->addMediaCollection('brochure')
            ->singleFile();
    }

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    public function scopeFeatured(Builder $query): Builder
    {
        return $query->where('is_featured', true);
    }
}