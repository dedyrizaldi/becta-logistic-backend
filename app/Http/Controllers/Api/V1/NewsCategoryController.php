<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Api\ApiController;
use App\Http\Resources\Api\V1\NewsCategoryResource;
use App\Models\NewsCategory;

class NewsCategoryController extends ApiController
{
    /**
     * GET /api/v1/news-categories
     */
    public function index()
    {
        $categories = NewsCategory::query()
            ->withCount([
                'news' => function ($query) {
                    $query->where('is_active', true);
                },
            ])
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->get();

        return $this->success(
            NewsCategoryResource::collection($categories),
            'News categories retrieved successfully.'
        );
    }
}