<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Api\ApiController;
use App\Http\Resources\Api\V1\HomepageResource;
use App\Services\HomepageService;

class HomeController extends ApiController
{

    public function __construct(
        protected HomepageService $homepageService
    ) {
    }

    /**
     * GET /api/v1/home
     */
    public function index()
    {
        return $this->success(
            new HomepageResource(
                $this->homepageService->getHomepage()
            ),
            'Homepage retrieved successfully.'
        );
    }
}