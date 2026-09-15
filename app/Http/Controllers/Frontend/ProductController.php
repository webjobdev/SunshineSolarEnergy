<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Admin\Product;
use Exception;
use Illuminate\Http\JsonResponse;

class ProductController extends Controller
{
    /**
     * Get all active products.
     *
     * @method GET
     * @url api/products
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        try {
            $products = Product::with(['brand', 'category'])
                ->active()
                ->orderBy('sort_order')
                ->paginate(20);

            return response()->json([
                'status' => true,
                'data' => $products
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get single product by slug.
     *
     * @method GET
     * @url api/products/{slug}
     *
     * @param string $slug
     * @return JsonResponse
     */
    public function show(string $slug): JsonResponse
    {
        try {
            $product = Product::with(['brand', 'category', 'galleries'])
                ->where('slug', $slug)
                ->active()
                ->firstOrFail();

            return response()->json([
                'status' => true,
                'data' => $product
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Product not found'
            ], 404);
        }
    }

    /**
     * Get new products.
     *
     * @method GET
     * @url api/products/new
     *
     * @return JsonResponse
     */
    public function newProducts(): JsonResponse
    {
        try {
            $products = Product::with(['brand', 'category'])
                ->active()
                ->new()
                ->orderBy('sort_order')
                ->paginate(20);

            return response()->json([
                'status' => true,
                'data' => $products
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get trending products.
     *
     * @method GET
     * @url api/products/trending
     *
     * @return JsonResponse
     */
    public function trendingProducts(): JsonResponse
    {
        try {
            $products = Product::with(['brand', 'category'])
                ->active()
                ->trending()
                ->orderBy('sort_order')
                ->paginate(20);

            return response()->json([
                'status' => true,
                'data' => $products
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get home page products.
     *
     * @method GET
     * @url api/products/home
     *
     * @return JsonResponse
     */
    public function homeProducts(): JsonResponse
    {
        try {
            $products = Product::with(['brand', 'category'])
                ->active()
                ->showOnHomePage()
                ->orderBy('sort_order')
                ->get();

            return response()->json([
                'status' => true,
                'data' => $products
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get products by brand.
     *
     * @method GET
     * @url api/products/brand/{slug}
     *
     * @param string $slug
     * @return JsonResponse
     */
    public function byBrand(string $slug): JsonResponse
    {
        try {
            $products = Product::with(['brand', 'category'])
                ->whereHas('brand', function ($query) use ($slug) {
                    $query->where('slug', $slug);
                })
                ->active()
                ->orderBy('sort_order')
                ->paginate(20);

            return response()->json([
                'status' => true,
                'data' => $products
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get products by category.
     *
     * @method GET
     * @url api/products/category/{slug}
     *
     * @param string $slug
     * @return JsonResponse
     */
    public function byCategory(string $slug): JsonResponse
    {
        try {
            $products = Product::with(['brand', 'category'])
                ->whereHas('category', function ($query) use ($slug) {
                    $query->where('slug', $slug);
                })
                ->active()
                ->orderBy('sort_order')
                ->paginate(20);

            return response()->json([
                'status' => true,
                'data' => $products
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }
}