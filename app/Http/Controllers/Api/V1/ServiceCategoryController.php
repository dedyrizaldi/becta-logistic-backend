<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Api\ApiController;
use App\Http\Resources\Api\V1\ServiceCategoryResource;
use App\Models\ServiceCategory;

class ServiceCategoryController extends ApiController
{
    /**
     * GET /api/v1/service-categories
     */
    public function index()
    {
        $categories = ServiceCategory::query()
            ->withCount('services')
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->get();

        return $this->success(
            ServiceCategoryResource::collection($categories),
            'Service categories retrieved successfully.'
        );
    }
}