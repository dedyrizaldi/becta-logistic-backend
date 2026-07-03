<?php

namespace App\Http\Resources\Api\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class FleetCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     */
    public function toArray(Request $request): array
    {
        return [

            'success' => true,

            'message' => 'Fleets retrieved successfully.',

            'data' => FleetCardResource::collection($this->collection),

            'links' => [

                'first' => $this->url(1),

                'last' => $this->url($this->lastPage()),

                'prev' => $this->previousPageUrl(),

                'next' => $this->nextPageUrl(),

            ],

            'meta' => [

                'current_page' => $this->currentPage(),

                'from' => $this->firstItem(),

                'last_page' => $this->lastPage(),

                'links' => $this->linkCollection(),

                'path' => $this->path(),

                'per_page' => $this->perPage(),

                'to' => $this->lastItem(),

                'total' => $this->total(),

            ],

        ];
    }
}