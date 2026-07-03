<?php

namespace App\Services;

use App\Models\Fleet;
use App\Models\HeroSlider;
use App\Models\Journey;
use App\Models\News;
use App\Models\Project;
use App\Models\Service;
use App\Models\TrustedClient;
use App\Models\WebsiteSetting;

class HomepageService
{
    public function getHomepageData(): array
    {
        return [

            /*
            |--------------------------------------------------------------------------
            | Website Settings
            |--------------------------------------------------------------------------
            */

            'website' => WebsiteSetting::query()->first(),

            /*
            |--------------------------------------------------------------------------
            | Hero Slider
            |--------------------------------------------------------------------------
            */

            'hero' => HeroSlider::query()
                ->where('is_active', true)
                ->orderBy('sort_order')
                ->get(),

            /*
            |--------------------------------------------------------------------------
            | Trusted Clients
            |--------------------------------------------------------------------------
            */

            'trusted_clients' => TrustedClient::query()
                ->where('is_active', true)
                ->orderBy('sort_order')
                ->get(),

            /*
            |--------------------------------------------------------------------------
            | Journey
            |--------------------------------------------------------------------------
            */

            'journey' => Journey::query()
                ->where('is_active', true)
                ->orderBy('sort_order')
                ->get(),

            /*
            |--------------------------------------------------------------------------
            | Featured Services
            |--------------------------------------------------------------------------
            */

            'featured_services' => Service::query()
                ->with([
                    'category',
                    'media',
                ])
                ->where('is_active', true)
                ->where('is_featured', true)
                ->orderBy('sort_order')
                ->take(6)
                ->get(),

            /*
            |--------------------------------------------------------------------------
            | Featured Projects
            |--------------------------------------------------------------------------
            */

            'featured_projects' => Project::query()
                ->with([
                    'category',
                    'media',
                ])
                ->where('is_active', true)
                ->where('is_featured', true)
                ->latest()
                ->take(6)
                ->get(),

            /*
            |--------------------------------------------------------------------------
            | Featured Fleets
            |--------------------------------------------------------------------------
            */

            'featured_fleets' => Fleet::query()
                ->with([
                    'category',
                    'media',
                ])
                ->where('is_active', true)
                ->where('is_featured', true)
                ->orderBy('sort_order')
                ->take(6)
                ->get(),

            /*
            |--------------------------------------------------------------------------
            | Latest News
            |--------------------------------------------------------------------------
            */

            'latest_news' => News::query()
                ->with([
                    'category',
                    'media',
                ])
                ->where('is_active', true)
                ->latest('published_at')
                ->take(3)
                ->get(),

        ];
    }
}