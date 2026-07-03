<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Api\ApiController;
use App\Http\Resources\Api\V1\NewsCardResource;
use App\Http\Resources\Api\V1\NewsCollection;
use App\Http\Resources\Api\V1\NewsResource;
use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends ApiController
{
    /**
     * GET /api/v1/news
     */
    public function index(Request $request)
    {
        $query = News::query()
            ->with([
                'category',
                'media',
            ])
            ->where('is_active', true);

        switch ($request->get('sort')) {

            case 'title':
                $query->orderBy('title');
                break;

            case 'popular':
                $query->orderByDesc('views');
                break;

            case 'oldest':
                $query->oldest('published_at');
                break;

            default:
                $query->latest('published_at');
                break;
        }

        $news = $query->paginate(9);

        return new NewsCollection($news);
    }

    /**
     * GET /api/v1/news/featured
     */
    public function featured()
    {
        $news = News::query()
            ->with([
                'category',
                'media',
            ])
            ->where('is_active', true)
            ->where('is_featured', true)
            ->latest('published_at')
            ->take(6)
            ->get();

        return $this->success(
            NewsCardResource::collection($news),
            'Featured news retrieved successfully.'
        );
    }

    /**
     * GET /api/v1/news/search?q=
     */
    public function search(Request $request)
    {
        $keyword = $request->get('q');

        $news = News::query()
            ->with([
                'category',
                'media',
            ])
            ->where('is_active', true)
            ->when($keyword, function ($query) use ($keyword) {

                $query->where(function ($query) use ($keyword) {

                    $query->where('title', 'like', "%{$keyword}%")
                        ->orWhere('excerpt', 'like', "%{$keyword}%")
                        ->orWhere('description', 'like', "%{$keyword}%")
                        ->orWhere('author', 'like', "%{$keyword}%");

                });

            })
            ->latest('published_at')
            ->paginate(9);

        return $this->paginated(
            NewsCardResource::collection($news),
            $news,
            'Search completed.'
        );
    }

    /**
     * GET /api/v1/news/category/{slug}
     */
    public function byCategory(string $slug)
    {
        $news = News::query()
            ->with([
                'category',
                'media',
            ])
            ->whereHas('category', function ($query) use ($slug) {

                $query->where('slug', $slug);

            })
            ->where('is_active', true)
            ->latest('published_at')
            ->paginate(9);

        return $this->paginated(
            NewsCardResource::collection($news),
            $news,
            'News retrieved successfully.'
        );
    }

    /**
     * GET /api/v1/news/{slug}
     */
    public function show(string $slug)
    {
        $news = News::query()
            ->with([
                'category',
                'media',
            ])
            ->where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();

        // Increment views
        $news->increment('views');
        $news->refresh();

        $relatedNews = News::query()
            ->with([
                'category',
                'media',
            ])
            ->where('news_category_id', $news->news_category_id)
            ->where('id', '!=', $news->id)
            ->where('is_active', true)
            ->latest('published_at')
            ->take(4)
            ->get();

        return $this->success(
            [
                'news' => new NewsResource($news),
                'related_news' => NewsCardResource::collection($relatedNews),
            ],
            'News retrieved successfully.'
        );
    }
}