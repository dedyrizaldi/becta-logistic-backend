<?php

namespace App\Http\Resources\Api\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class NewsResource extends JsonResource
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

            'author' => $this->author,

            'source' => $this->source,

            'reading_time' => $this->reading_time,

            'views' => $this->views,

            'excerpt' => $this->excerpt,

            'description' => $this->description,

            'published_at' => optional($this->published_at)->format('Y-m-d'),

            /*
            |--------------------------------------------------------------------------
            | Media
            |--------------------------------------------------------------------------
            */

            'thumbnail' => $this->getFirstMediaUrl('thumbnail') ?: null,

            'cover' => $this->getFirstMediaUrl('cover') ?: null,

            'gallery' => $this->getMedia('gallery')->map(function ($media) {

                return [

                    'id' => $media->id,

                    'url' => $media->getUrl(),

                ];

            }),

            /*
            |--------------------------------------------------------------------------
            | Category
            |--------------------------------------------------------------------------
            */

            'category' => [

                'id' => $this->category?->id,

                'name' => $this->category?->name,

                'slug' => $this->category?->slug,

            ],

            /*
            |--------------------------------------------------------------------------
            | Tags
            |--------------------------------------------------------------------------
            */

            'tags' => $this->tags ?? [],

            /*
            |--------------------------------------------------------------------------
            | SEO
            |--------------------------------------------------------------------------
            */

            'meta' => [

                'title' => $this->seo_title,

                'description' => $this->seo_description,

            ],

            /*
            |--------------------------------------------------------------------------
            | Status
            |--------------------------------------------------------------------------
            */

            'featured' => (bool) $this->is_featured,

            'published' => (bool) $this->is_active,

            /*
            |--------------------------------------------------------------------------
            | Timestamp
            |--------------------------------------------------------------------------
            */

            'created_at' => $this->created_at,

            'updated_at' => $this->updated_at,

        ];
    }
}