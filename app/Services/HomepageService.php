<?php

namespace App\Services;

use App\Repositories\Contracts\HomepageRepositoryInterface;
use App\Support\CacheKeys;
use Illuminate\Support\Facades\Cache;
use Carbon\CarbonInterval;

class HomepageService
{
    public function __construct(
        protected HomepageRepositoryInterface $repository
    ) {
    }

    public function getHomepage(): array
    {
        return Cache::remember(

            CacheKeys::HOMEPAGE,

            CarbonInterval::minutes(30),

            fn () => $this->repository->getHomepageData()

        );
    }

    public function clearHomepageCache(): void
    {
        Cache::forget(CacheKeys::HOMEPAGE);
    }
}