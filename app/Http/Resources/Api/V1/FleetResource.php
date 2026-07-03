<?php

namespace App\Http\Resources\Api\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FleetResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [

            'id' => $this->id,

            'title' => $this->title,

            'slug' => $this->slug,

            'code' => $this->code,

            'excerpt' => $this->excerpt,

            'description' => $this->description,

            'thumbnail' => $this->getFirstMediaUrl('thumbnail') ?: null,

            'gallery' => $this->getMedia('gallery')->map(function ($media) {
                return [
                    'id' => $media->id,
                    'url' => $media->getUrl(),
                ];
            }),

            'brochure' => $this->getFirstMediaUrl('brochure') ?: null,

            'category' => [
                'id' => $this->category?->id,
                'name' => $this->category?->name,
                'slug' => $this->category?->slug,
            ],

            /*
            |--------------------------------------------------------------------------
            | Principal Particulars
            |--------------------------------------------------------------------------
            */

            'specification' => [

                'loa' => $this->loa,

                'beam' => $this->beam,

                'depth' => $this->depth,

                'gt' => $this->gt,

                'cargo_capacity' => $this->cargo_capacity,

            ],

            /*
            |--------------------------------------------------------------------------
            | Technical
            |--------------------------------------------------------------------------
            */

            'technical' => [

                'engine' => $this->engine,

                'speed' => $this->speed,

                'crew' => $this->crew,

                'built_year' => $this->built_year,

                'flag' => $this->flag,

            ],

            'featured' => (bool) $this->is_featured,

            'published' => (bool) $this->is_active,

            'meta' => [

                'title' => $this->seo_title,

                'description' => $this->seo_description,

            ],

            'created_at' => $this->created_at,

            'updated_at' => $this->updated_at,

        ];
    }
}