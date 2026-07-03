<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Api\ApiController;
use App\Http\Resources\Api\V1\FleetCategoryResource;
use App\Models\FleetCategory;

class FleetCategoryController extends ApiController
{
    /**
     * GET /api/v1/fleet-categories
     */
    public function index()
    {
        $categories = FleetCategory::query()
            ->withCount('fleets')
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->get();

        return $this->success(
            FleetCategoryResource::collection($categories),
            'Fleet categories retrieved successfully.'
        );
    }
}