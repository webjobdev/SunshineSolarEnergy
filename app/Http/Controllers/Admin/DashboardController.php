<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\CustomerReview;
use App\Models\Admin\Page;
use App\Models\Admin\Product;
use App\Models\Admin\ProductBrand;
use App\Models\Admin\ProductCategory;
use App\Models\Admin\Service;
use App\Models\Admin\WebsiteConfiguration;
use Exception;
use Illuminate\Contracts\View\View;

class DashboardController extends Controller
{
    /**
     * Display the admin dashboard.
     *
     * @method GET
     *
     * @url admin/dashboard
     *
     * @name admin.dashboard
     */
    public function index(): View|array
    {
        try {
            // ============================
            // Product Statistics
            // ============================
            $totalProducts = Product::count();
            $activeProducts = Product::where('status', 'active')->count();
            $inactiveProducts = Product::where('status', 'inactive')->count();
            $trendingProducts = Product::where('trending', 'active')->count();
            $newProductsCount = Product::where('new', 'active')->count();
            $homepageProducts = Product::where('show_on_home_page', 'active')->count();

            // ============================
            // Brands & Categories
            // ============================
            $totalBrands = ProductBrand::count();
            $activeBrands = ProductBrand::where('status', 'active')->count();
            $totalCategories = ProductCategory::count();
            $activeCategories = ProductCategory::where('status', 'active')->count();

            // ============================
            // Services
            // ============================
            $totalServices = Service::count();
            $activeServices = Service::where('status', 'active')->count();

            // ============================
            // Customer Reviews
            // ============================
            $totalReviews = CustomerReview::count();
            $activeReviews = CustomerReview::where('status', 'active')->count();

            // ============================
            // Pages
            // ============================
            $totalPages = Page::count();
            $activePages = Page::where('status', 'active')->count();
            $inactivePages = Page::where('status', 'inactive')->count();

            // ============================
            // Social Media Count
            // ============================
            $socialCount = WebsiteConfiguration::where('config_group', 'social')
                ->where('config_type', 'url')
                ->whereNotNull('config_value')
                ->where('config_value', '!=', '')
                ->count();

            // ============================
            // Recent Products
            // ============================
            $recentProducts = Product::with(['brand', 'category'])
                ->latest()
                ->take(5)
                ->get();

            return view('admin.pages.dashboard.dashboard', compact(
                'totalProducts',
                'activeProducts',
                'inactiveProducts',
                'trendingProducts',
                'newProductsCount',
                'homepageProducts',
                'totalBrands',
                'activeBrands',
                'totalCategories',
                'activeCategories',
                'totalServices',
                'activeServices',
                'totalReviews',
                'activeReviews',
                'totalPages',
                'activePages',
                'inactivePages',
                'socialCount',
                'recentProducts'
            ));
        } catch (Exception $exception) {
            return errorResponse($exception->getMessage());
        }
    }
}
