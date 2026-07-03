<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\ProjectController;
use App\Http\Controllers\Api\V1\ProjectCategoryController;
use App\Http\Controllers\Api\V1\ServiceController;
use App\Http\Controllers\Api\V1\ServiceCategoryController;
use App\Http\Controllers\Api\V1\FleetController;
use App\Http\Controllers\Api\V1\FleetCategoryController;
use App\Http\Controllers\Api\V1\NewsController;
use App\Http\Controllers\Api\V1\NewsCategoryController;
use App\Http\Controllers\Api\V1\HomeController;

Route::prefix('v1')->group(function () {

    /*
    |--------------------------------------------------------------------------
    | Projects
    |--------------------------------------------------------------------------
    */

    Route::get('/projects', [ProjectController::class, 'index']);

    Route::get('/projects/featured', [ProjectController::class, 'featured']);

    Route::get('/projects/search', [ProjectController::class, 'search']);

    Route::get('/projects/category/{slug}', [ProjectController::class, 'byCategory']);

    Route::get('/projects/{slug}', [ProjectController::class, 'show']);

    Route::get('/project-categories', [ProjectCategoryController::class, 'index']);


    /*
    |--------------------------------------------------------------------------
    | Services
    |--------------------------------------------------------------------------
    */

    Route::get('/services', [ServiceController::class, 'index']);

    Route::get('/services/featured', [ServiceController::class, 'featured']);

    Route::get('/services/search', [ServiceController::class, 'search']);

    Route::get('/services/category/{slug}', [ServiceController::class, 'byCategory']);

    Route::get('/services/{slug}', [ServiceController::class, 'show']);

    Route::get('/service-categories', [ServiceCategoryController::class, 'index']);

    /*
    |--------------------------------------------------------------------------
    | Fleets
    |--------------------------------------------------------------------------
    */

    Route::get('/fleets', [FleetController::class, 'index']);

    Route::get('/fleets/featured', [FleetController::class, 'featured']);

    Route::get('/fleets/search', [FleetController::class, 'search']);

    Route::get('/fleets/category/{slug}', [FleetController::class, 'byCategory']);

    Route::get('/fleets/{slug}', [FleetController::class, 'show']);

    Route::get('/fleet-categories', [FleetCategoryController::class, 'index']);

    /*
    |--------------------------------------------------------------------------
    | News
    |--------------------------------------------------------------------------
    */

    Route::get('/news', [NewsController::class, 'index']);

    Route::get('/news/featured', [NewsController::class, 'featured']);

    Route::get('/news/search', [NewsController::class, 'search']);

    Route::get('/news/category/{slug}', [NewsController::class, 'byCategory']);

    Route::get('/news/{slug}', [NewsController::class, 'show']);

    Route::get('/news-categories', [NewsCategoryController::class, 'index']);

    /*
    |--------------------------------------------------------------------------
    | Homepage
    |--------------------------------------------------------------------------
    */

    Route::get('/home', [HomeController::class, 'index']);
});