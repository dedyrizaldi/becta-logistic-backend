<?php

namespace App\Http\Resources\Api\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class HomeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [

            /*
            |--------------------------------------------------------------------------
            | Website
            |--------------------------------------------------------------------------
            */

            'website' => new WebsiteSettingResource(
                $this['website']
            ),

            /*
            |--------------------------------------------------------------------------
            | Hero
            |--------------------------------------------------------------------------
            */

            'hero' => HeroSliderResource::collection(
                $this['hero']
            ),

            /*
            |--------------------------------------------------------------------------
            | Trusted Clients
            |--------------------------------------------------------------------------
            */

            'trusted_clients' => TrustedClientResource::collection(
                $this['trusted_clients']
            ),

            /*
            |--------------------------------------------------------------------------
            | Journey
            |--------------------------------------------------------------------------
            */

            'journey' => JourneyResource::collection(
                $this['journey']
            ),

            /*
            |--------------------------------------------------------------------------
            | Homepage Sections
            |--------------------------------------------------------------------------
            */

            'featured_services' => ServiceCardResource::collection(
                $this['featured_services']
            ),

            'featured_projects' => ProjectCardResource::collection(
                $this['featured_projects']
            ),

            'featured_fleets' => FleetCardResource::collection(
                $this['featured_fleets']
            ),

            'latest_news' => NewsCardResource::collection(
                $this['latest_news']
            ),

        ];
    }
}