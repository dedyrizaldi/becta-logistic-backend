<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Builder;

class Journey extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected $fillable = [

        /*
        |--------------------------------------------------------------------------
        | Content
        |--------------------------------------------------------------------------
        */

        'title',
        'subtitle',
        'description',

        /*
        |--------------------------------------------------------------------------
        | Action
        |--------------------------------------------------------------------------
        */

        'button_text',
        'button_url',

        /*
        |--------------------------------------------------------------------------
        | Publish
        |--------------------------------------------------------------------------
        */

        'sort_order',
        'is_active',

    ];

    protected $casts = [

        'is_active' => 'boolean',

    ];

    public function registerMediaCollections(): void
    {
        $this
            ->addMediaCollection('image')
            ->singleFile();
    }

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    public function scopeOrdered(Builder $query): Builder
    {
        return $query->orderBy('sort_order');
    }
}