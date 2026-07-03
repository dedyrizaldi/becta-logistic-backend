<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

class ApiController extends Controller
{
    /**
     * Success Response
     */
    protected function success(
        mixed $data = null,
        string $message = 'Success',
        int $status = 200,
        array $meta = []
    ): JsonResponse {

        $response = [
            'success' => true,
            'message' => $message,
            'data' => $data,
        ];

        if (! empty($meta)) {
            $response['meta'] = $meta;
        }

        return response()->json($response, $status);
    }

    /**
     * Error Response
     */
    protected function error(
        string $message = 'Something went wrong.',
        int $status = 400,
        mixed $errors = null
    ): JsonResponse {

        $response = [
            'success' => false,
            'message' => $message,
        ];

        if (! is_null($errors)) {
            $response['errors'] = $errors;
        }

        return response()->json($response, $status);
    }

    /**
     * Paginated Response
     */
    protected function paginated(
        mixed $data,
        $paginator,
        string $message = 'Success'
    ): JsonResponse {

        return response()->json([

            'success' => true,

            'message' => $message,

            'data' => $data,

            'meta' => [

                'current_page' => $paginator->currentPage(),

                'last_page' => $paginator->lastPage(),

                'per_page' => $paginator->perPage(),

                'total' => $paginator->total(),

            ],

            'links' => [

                'first' => $paginator->url(1),

                'last' => $paginator->url($paginator->lastPage()),

                'prev' => $paginator->previousPageUrl(),

                'next' => $paginator->nextPageUrl(),

            ],

        ]);
    }
}