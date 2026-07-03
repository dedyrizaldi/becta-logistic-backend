<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Api\ApiController;
use App\Http\Resources\Api\V1\ProjectCardResource;
use App\Http\Resources\Api\V1\ProjectCollection;
use App\Http\Resources\Api\V1\ProjectResource;
use App\Models\Project;

class ProjectController extends ApiController
{
    /**
     * GET /api/v1/projects
     */
    public function index()
    {
        $projects = Project::query()
            ->with([
                'category',
                'media',
            ])
            ->where('is_active', true)
            ->latest()
            ->paginate(9);

        return new ProjectCollection($projects);
    }

    /**
     * GET /api/v1/projects/featured
     */
    public function featured()
    {
        $projects = Project::query()
            ->with([
                'category',
                'media',
            ])
            ->where('is_active', true)
            ->where('is_featured', true)
            ->orderBy('sort_order')
            ->latest()
            ->take(6)
            ->get();

        return $this->success(
            ProjectCardResource::collection($projects),
            'Featured projects retrieved successfully.'
        );
    }

    /**
     * GET /api/v1/projects/search?q=
     */
    public function search()
    {
        $keyword = request('q');

        $projects = Project::query()
            ->with([
                'category',
                'media',
            ])
            ->where('is_active', true)
            ->when($keyword, function ($query) use ($keyword) {
                $query->where(function ($query) use ($keyword) {
                    $query->where('title', 'like', "%{$keyword}%")
                        ->orWhere('client', 'like', "%{$keyword}%")
                        ->orWhere('location', 'like', "%{$keyword}%")
                        ->orWhere('excerpt', 'like', "%{$keyword}%");
                });
            })
            ->latest()
            ->paginate(9);

        return $this->paginated(
            ProjectCardResource::collection($projects),
            $projects,
            'Search completed.'
        );
    }

    /**
     * GET /api/v1/projects/category/{slug}
     */
    public function byCategory(string $slug)
    {
        $projects = Project::query()
            ->with([
                'category',
                'media',
            ])
            ->whereHas('category', function ($query) use ($slug) {
                $query->where('slug', $slug);
            })
            ->where('is_active', true)
            ->latest()
            ->paginate(9);

        return $this->paginated(
            ProjectCardResource::collection($projects),
            $projects,
            'Projects retrieved successfully.'
        );
    }

    /**
     * GET /api/v1/projects/{slug}
     */
    public function show(string $slug)
    {
        $project = Project::query()
            ->with([
                'category',
                'media',
            ])
            ->where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();

        $relatedProjects = Project::query()
            ->with([
                'category',
                'media',
            ])
            ->where('project_category_id', $project->project_category_id)
            ->where('id', '!=', $project->id)
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->latest()
            ->take(3)
            ->get();

        return $this->success(
            [
                'project' => new ProjectResource($project),
                'related_projects' => ProjectCardResource::collection($relatedProjects),
            ],
            'Project retrieved successfully.'
        );
    }
}