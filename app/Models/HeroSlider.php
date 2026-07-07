<?php

namespace App\Models;

use App\Observers\HeroSliderObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

#[ObservedBy([HeroSliderObserver::class])]
class HeroSlider extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected $fillable = [

        'title',

        'subtitle',

        'description',

        'primary_button_text',
        'primary_button_url',

        'secondary_button_text',
        'secondary_button_url',

        'sort_order',

        'is_active',

    ];

    protected $casts = [

        'is_active' => 'boolean',

    ];

    /*
    |--------------------------------------------------------------------------
    | Media Collections
    |--------------------------------------------------------------------------
    */

    // public function registerMediaCollections(): void
    // {
    //     $this
    //         ->addMediaCollection('desktop')
    //         ->useDisk('public')
    //         ->singleFile();

    //     $this
    //         ->addMediaCollection('mobile')
    //         ->useDisk('public')
    //         ->singleFile();
    // }

    //old function registerMediaCollections(): void
    public function registerMediaCollections(): void
    {
        $this
            ->addMediaCollection('desktop')
            ->singleFile();

        $this
            ->addMediaCollection('mobile')
            ->singleFile();
    }

    /*
    |--------------------------------------------------------------------------
    | Query Scopes
    |--------------------------------------------------------------------------
    */

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    public function scopeInactive(Builder $query): Builder
    {
        return $query->where('is_active', false);
    }

    public function scopeOrdered(Builder $query): Builder
    {
        return $query->orderBy('sort_order');
    }
}