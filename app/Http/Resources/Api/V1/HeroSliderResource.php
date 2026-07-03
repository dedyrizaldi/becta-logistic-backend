<?php

namespace App\Http\Resources\Api\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class HeroSliderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [

            /*
            |--------------------------------------------------------------------------
            | Identity
            |--------------------------------------------------------------------------
            */

            'id' => $this->id,

            'title' => $this->title,

            'subtitle' => $this->subtitle,

            'description' => $this->description,

            /*
            |--------------------------------------------------------------------------
            | Buttons
            |--------------------------------------------------------------------------
            */

            'primary_button' => [

                'text' => $this->primary_button_text,

                'url' => $this->primary_button_url,

            ],

            'secondary_button' => [

                'text' => $this->secondary_button_text,

                'url' => $this->secondary_button_url,

            ],

            /*
            |--------------------------------------------------------------------------
            | Images
            |--------------------------------------------------------------------------
            */

            'desktop_image' => $this->getFirstMediaUrl('desktop') ?: null,

            'mobile_image' => $this->getFirstMediaUrl('mobile') ?: null,

            /*
            |--------------------------------------------------------------------------
            | Settings
            |--------------------------------------------------------------------------
            */

            'sort_order' => $this->sort_order,

            'is_active' => (bool) $this->is_active,

        ];
    }
}