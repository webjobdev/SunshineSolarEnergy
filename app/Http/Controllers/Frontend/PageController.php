<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Admin\Page;
use Exception;
use Illuminate\Http\JsonResponse;

class PageController extends Controller
{
    /**
     * Get all active pages.
     *
     * @method GET
     * @url api/pages
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        try {
            $pages = Page::where('status', 'active')
                ->select('id', 'page_name', 'slug', 'meta_title', 'meta_description', 'status')
                ->get();
            
            return response()->json([
                'status' => true,
                'data' => $pages
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get single page by slug.
     *
     * @method GET
     * @url api/pages/{slug}
     *
     * @param string $slug
     * @return JsonResponse
     */
    public function show(string $slug): JsonResponse
    {
        try {
            $page = Page::where('slug', $slug)
                ->where('status', 'active')
                ->firstOrFail();
            
            return response()->json([
                'status' => true,
                'data' => $page
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Page not found'
            ], 404);
        }
    }

    /**
     * Get home page.
     *
     * @method GET
     * @url api/pages/home
     *
     * @return JsonResponse
     */
    public function home(): JsonResponse
    {
        try {
            $page = Page::where('slug', 'home')
                ->where('status', 'active')
                ->first();
            
            return response()->json([
                'status' => true,
                'data' => $page
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get about page.
     *
     * @method GET
     * @url api/pages/about
     *
     * @return JsonResponse
     */
    public function about(): JsonResponse
    {
        try {
            $page = Page::where('slug', 'about')
                ->where('status', 'active')
                ->first();
            
            return response()->json([
                'status' => true,
                'data' => $page
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get services page.
     *
     * @method GET
     * @url api/pages/services
     *
     * @return JsonResponse
     */
    public function services(): JsonResponse
    {
        try {
            $page = Page::where('slug', 'services')
                ->where('status', 'active')
                ->first();
            
            return response()->json([
                'status' => true,
                'data' => $page
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get contact page.
     *
     * @method GET
     * @url api/pages/contact
     *
     * @return JsonResponse
     */
    public function contact(): JsonResponse
    {
        try {
            $page = Page::where('slug', 'contact')
                ->where('status', 'active')
                ->first();
            
            return response()->json([
                'status' => true,
                'data' => $page
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }
}