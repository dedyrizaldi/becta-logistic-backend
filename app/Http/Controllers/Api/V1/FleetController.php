<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Api\ApiController;
use App\Http\Resources\Api\V1\FleetCardResource;
use App\Http\Resources\Api\V1\FleetCollection;
use App\Http\Resources\Api\V1\FleetResource;
use App\Models\Fleet;
use Illuminate\Http\Request;

class FleetController extends ApiController
{
    /**
     * GET /api/v1/fleets
     */
    public function index(Request $request)
    {
        $query = Fleet::query()
            ->with([
                'category',
                'media',
            ])
            ->where('is_active', true);

        switch ($request->get('sort')) {

            case 'title':
                $query->orderBy('title');
                break;

            case 'capacity':
                $query->orderByDesc('cargo_capacity');
                break;

            case 'newest':
                $query->latest();
                break;

            default:
                $query->orderBy('sort_order')
                      ->latest();
                break;
        }

        $fleets = $query->paginate(9);

        return new FleetCollection($fleets);
    }

    /**
     * GET /api/v1/fleets/featured
     */
    public function featured()
    {
        $fleets = Fleet::query()
            ->with([
                'category',
                'media',
            ])
            ->where('is_active', true)
            ->where('is_featured', true)
            ->orderBy('sort_order')
            ->take(6)
            ->get();

        return $this->success(
            FleetCardResource::collection($fleets),
            'Featured fleets retrieved successfully.'
        );
    }

    /**
     * GET /api/v1/fleets/search?q=
     */
    public function search(Request $request)
    {
        $keyword = $request->get('q');

        $fleets = Fleet::query()
            ->with([
                'category',
                'media',
            ])
            ->where('is_active', true)
            ->when($keyword, function ($query) use ($keyword) {

                $query->where(function ($query) use ($keyword) {

                    $query->where('title', 'like', "%{$keyword}%")
                        ->orWhere('code', 'like', "%{$keyword}%")
                        ->orWhere('excerpt', 'like', "%{$keyword}%")
                        ->orWhere('description', 'like', "%{$keyword}%");

                });

            })
            ->orderBy('sort_order')
            ->paginate(9);

        return $this->paginated(
            FleetCardResource::collection($fleets),
            $fleets,
            'Search completed.'
        );
    }

    /**
     * GET /api/v1/fleets/category/{slug}
     */
    public function byCategory(string $slug)
    {
        $fleets = Fleet::query()
            ->with([
                'category',
                'media',
            ])
            ->whereHas('category', function ($query) use ($slug) {

                $query->where('slug', $slug);

            })
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->paginate(9);

        return $this->paginated(
            FleetCardResource::collection($fleets),
            $fleets,
            'Fleets retrieved successfully.'
        );
    }

    /**
     * GET /api/v1/fleets/{slug}
     */
    public function show(string $slug)
    {
        $fleet = Fleet::query()
            ->with([
                'category',
                'media',
            ])
            ->where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();

        $relatedFleets = Fleet::query()
            ->with([
                'category',
                'media',
            ])
            ->where('fleet_category_id', $fleet->fleet_category_id)
            ->where('id', '!=', $fleet->id)
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->take(3)
            ->get();

        return $this->success(
            [
                'fleet' => new FleetResource($fleet),
                'related_fleets' => FleetCardResource::collection($relatedFleets),
            ],
            'Fleet retrieved successfully.'
        );
    }
}