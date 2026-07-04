<?php

namespace App\Observers;

use App\Models\HeroSlider;
use App\Services\CacheService;

class HeroSliderObserver
{
    public function created(HeroSlider $heroSlider): void
    {
        CacheService::clearHomepageDependencies();
    }

    public function updated(HeroSlider $heroSlider): void
    {
        CacheService::clearHomepageDependencies();
    }

    public function deleted(HeroSlider $heroSlider): void
    {
        CacheService::clearHomepageDependencies();
    }

    public function restored(HeroSlider $heroSlider): void
    {
        CacheService::clearHomepageDependencies();
    }

    public function forceDeleted(HeroSlider $heroSlider): void
    {
        CacheService::clearHomepageDependencies();
    }
}