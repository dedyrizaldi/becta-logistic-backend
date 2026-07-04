<?php

namespace App\Repositories\Eloquent;

use App\Models\Fleet;
use App\Models\HeroSlider;
use App\Models\Journey;
use App\Models\News;
use App\Models\Project;
use App\Models\Service;
use App\Models\TrustedClient;
use App\Models\WebsiteSetting;
use App\Repositories\Contracts\HomepageRepositoryInterface;

class HomepageRepository implements HomepageRepositoryInterface
{
    public function getHomepageData(): array
    {
        return [

            'website' => WebsiteSetting::first(),

            'hero' => HeroSlider::active()
                ->ordered()
                ->get(),

            'trusted_clients' => TrustedClient::active()
                ->ordered()
                ->get(),

            'journey' => Journey::active()
                ->ordered()
                ->get(),

            'featured_services' => Service::active()
                ->featured()
                ->latest()
                ->take(6)
                ->get(),

            'featured_projects' => Project::active()
                ->featured()
                ->published()
                ->latest()
                ->take(6)
                ->get(),

            'featured_fleets' => Fleet::active()
                ->featured()
                ->latest()
                ->take(6)
                ->get(),

            'latest_news' => News::active()
                ->published()
                ->latest()
                ->take(3)
                ->get(),

        ];
    }
}