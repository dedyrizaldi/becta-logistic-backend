<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\V1\ProjectCategoryResource;
use App\Models\ProjectCategory;

class ProjectCategoryController extends Controller
{
    /**
     * GET /api/v1/project-categories
     */
    public function index()
    {
        $categories = ProjectCategory::query()
            ->withCount([
                'projects' => function ($query) {
                    $query->where('is_active', true);
                },
            ])
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->get();

        return response()->json([

            'success' => true,

            'message' => 'Project categories retrieved successfully.',

            'data' => ProjectCategoryResource::collection($categories),

        ]);
    }
}