<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Admin\Service;
use Exception;
use Illuminate\Http\JsonResponse;

class ServiceController extends Controller
{
    /**
     * Get all active services.
     *
     * @method GET
     * @url api/services
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        try {
            $services = Service::active()
                ->orderBy('sort_order')
                ->get();

            return response()->json([
                'status' => true,
                'data' => $services
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get single service by slug.
     *
     * @method GET
     * @url api/services/{slug}
     *
     * @param string $slug
     * @return JsonResponse
     */
    public function show(string $slug): JsonResponse
    {
        try {
            $service = Service::where('slug', $slug)
                ->active()
                ->firstOrFail();

            return response()->json([
                'status' => true,
                'data' => $service
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Service not found'
            ], 404);
        }
    }
}