<?php

namespace App\Services;

use App\Support\CacheKeys;
use Illuminate\Support\Facades\Cache;

class CacheService
{
    /**
     * Clear Homepage Cache
     */
    public static function clearHomepage(): void
    {
        Cache::forget(CacheKeys::HOMEPAGE);
    }

    /**
     * Clear Services Cache
     */
    public static function clearServices(): void
    {
        Cache::forget(CacheKeys::SERVICES);
    }

    /**
     * Clear Projects Cache
     */
    public static function clearProjects(): void
    {
        Cache::forget(CacheKeys::PROJECTS);
    }

    /**
     * Clear Fleets Cache
     */
    public static function clearFleets(): void
    {
        Cache::forget(CacheKeys::FLEETS);
    }

    /**
     * Clear News Cache
     */
    public static function clearNews(): void
    {
        Cache::forget(CacheKeys::NEWS);
    }

    /**
     * Clear Journey Cache
     */
    public static function clearJourney(): void
    {
        Cache::forget(CacheKeys::JOURNEY);
    }

    /**
     * Clear Website Cache
     */
    public static function clearWebsite(): void
    {
        Cache::forget(CacheKeys::WEBSITE);
    }

    /**
     * Clear Trusted Client Cache
     */
    public static function clearTrustedClients(): void
    {
        Cache::forget(CacheKeys::TRUSTED_CLIENTS);
    }

    /**
     * Clear all homepage related cache
     */
    public static function clearHomepageDependencies(): void
    {
        self::clearHomepage();
    }
}