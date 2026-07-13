<?php

namespace App\Http\Resources\Api\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class NewsCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'success' => true,

            'message' => 'News retrieved successfully.',

            'data' => NewsCardResource::collection($this->collection),
        ];
    }

    /**
     * Additional data for paginated responses.
     */
    public function with(Request $request): array
    {
        return [];
    }
}