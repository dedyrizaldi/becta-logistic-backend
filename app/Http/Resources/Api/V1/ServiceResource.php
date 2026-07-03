<?php

namespace App\Http\Resources\Api\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ServiceResource extends JsonResource
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

            'excerpt' => $this->excerpt,

            'description' => $this->description,

            'thumbnail' => $this->getFirstMediaUrl('thumbnail') ?: null,

            'gallery' => $this->getMedia('gallery')->map(function ($media) {
                return [
                    'id' => $media->id,
                    'url' => $media->getUrl(),
                ];
            }),

            'category' => [
                'id' => $this->category?->id,
                'name' => $this->category?->name,
                'slug' => $this->category?->slug,
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