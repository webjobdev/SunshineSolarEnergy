<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Admin\CustomerReview;
use Exception;
use Illuminate\Http\JsonResponse;

class CustomerReviewController extends Controller
{
    /**
     * Get all active customer reviews.
     *
     * @method GET
     * @url api/customer-reviews
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        try {
            $reviews = CustomerReview::active()
                ->orderBy('sort_order')
                ->get();

            return response()->json([
                'status' => true,
                'data' => $reviews
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }
}