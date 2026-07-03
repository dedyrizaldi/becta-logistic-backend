<?php

namespace App\Http\Resources\Api\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class NewsCardResource extends JsonResource
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

            'excerpt' => $this->excerpt,

            'reading_time' => $this->reading_time,

            'views' => $this->views,

            'published_at' => optional($this->published_at)->format('Y-m-d'),

            'thumbnail' => $this->getFirstMediaUrl('thumbnail') ?: null,

            'category' => [
                'id' => $this->category?->id,
                'name' => $this->category?->name,
                'slug' => $this->category?->slug,
            ],

        ];
    }
}