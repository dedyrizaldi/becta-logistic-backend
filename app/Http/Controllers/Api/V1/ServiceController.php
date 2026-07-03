<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Api\ApiController;
use App\Http\Resources\Api\V1\ServiceCardResource;
use App\Http\Resources\Api\V1\ServiceCollection;
use App\Http\Resources\Api\V1\ServiceResource;
use App\Models\Service;

class ServiceController extends ApiController
{
    /**
     * GET /api/v1/services
     */
    public function index()
    {
        $services = Service::query()
            ->with([
                'category',
                'media',
            ])
            ->where('is_active', true)
            ->latest()
            ->paginate(9);

        return new ServiceCollection($services);
    }

    /**
     * GET /api/v1/services/featured
     */
    public function featured()
    {
        $services = Service::query()
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
            ServiceCardResource::collection($services),
            'Featured services retrieved successfully.'
        );
    }

    /**
     * GET /api/v1/services/search?q=
     */
    public function search()
    {
        $keyword = request('q');

        $services = Service::query()
            ->with([
                'category',
                'media',
            ])
            ->where('is_active', true)
            ->when($keyword, function ($query) use ($keyword) {
                $query->where(function ($query) use ($keyword) {
                    $query->where('title', 'like', "%{$keyword}%")
                        ->orWhere('excerpt', 'like', "%{$keyword}%")
                        ->orWhere('description', 'like', "%{$keyword}%");
                });
            })
            ->latest()
            ->paginate(9);

        return $this->paginated(
            ServiceCardResource::collection($services),
            $services,
            'Search completed.'
        );
    }

    /**
     * GET /api/v1/services/category/{slug}
     */
    public function byCategory(string $slug)
    {
        $services = Service::query()
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
            ServiceCardResource::collection($services),
            $services,
            'Services retrieved successfully.'
        );
    }

    /**
     * GET /api/v1/services/{slug}
     */
    public function show(string $slug)
    {
        $service = Service::query()
            ->with([
                'category',
                'media',
            ])
            ->where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();

        $relatedServices = Service::query()
            ->with([
                'category',
                'media',
            ])
            ->where('service_category_id', $service->service_category_id)
            ->where('id', '!=', $service->id)
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->latest()
            ->take(3)
            ->get();

        return $this->success(
            [
                'service' => new ServiceResource($service),
                'related_services' => ServiceCardResource::collection($relatedServices),
            ],
            'Service retrieved successfully.'
        );
    }
}