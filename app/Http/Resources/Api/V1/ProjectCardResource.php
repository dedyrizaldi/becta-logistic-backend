<?php

namespace App\Http\Resources\Api\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProjectCardResource extends JsonResource
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

            'client' => $this->client,

            'location' => $this->location,

            'excerpt' => $this->excerpt,

            'completed_at' => optional($this->completed_at)?->format('Y-m-d'),

            'thumbnail' => $this->getFirstMedia('thumbnail')
                ? $this->getFirstMedia('thumbnail')->getFullUrl()
                : null,

            'category' => [
                'id' => $this->category?->id,
                'name' => $this->category?->name,
                'slug' => $this->category?->slug,
            ],
        ];
    }
}