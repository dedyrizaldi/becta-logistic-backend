<?php

namespace App\Http\Resources\Api\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FleetCardResource extends JsonResource
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

            'thumbnail' => $this->getFirstMediaUrl('thumbnail') ?: null,

            'category' => [
                'id' => $this->category?->id,
                'name' => $this->category?->name,
                'slug' => $this->category?->slug,
            ],

            'specification' => [

                'loa' => $this->loa,

                'beam' => $this->beam,

                'depth' => $this->depth,

                'gt' => $this->gt,

                'cargo_capacity' => $this->cargo_capacity,

            ],

        ];
    }
}