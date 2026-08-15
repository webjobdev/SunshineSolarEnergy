<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Blog;
use App\Models\Admin\BlogCategory;
use App\Models\Admin\BlogComment;
use App\Models\Admin\BlogTag;
use App\Models\Admin\Page;
use App\Models\Admin\WebsiteConfiguration;
use Exception;
use Illuminate\Contracts\View\View;

class DashboardController extends Controller
{
    /**
     * Display the admin dashboard.
     *
     * @method GET
     * @url admin/dashboard
     * @name admin.dashboard
     *
     * @return View|array
     */
    public function index(): View|array
    {
        try {
            // Blog Statistics
            $totalBlogs = Blog::count();
            $publishedBlogs = Blog::where('status', 'published')->count();
            $draftBlogs = Blog::where('status', 'draft')->count();

            // Page Statistics
            $totalPages = Page::count();
            $activePages = Page::where('status', 'active')->count();
            $inactivePages = Page::where('status', 'inactive')->count();

            // Comment Statistics
            $totalComments = BlogComment::count();
            $approvedComments = BlogComment::where('status', 'approved')->count();
            $pendingComments = BlogComment::where('status', 'pending')->count();

            // Category & Tag Statistics
            $totalCategories = BlogCategory::count();
            $activeCategories = BlogCategory::where('status', 'active')->count();
            $totalTags = BlogTag::count();
            $activeTags = BlogTag::where('status', 'active')->count();

            // Social Media Count
            $socialConfigs = WebsiteConfiguration::where('config_group', 'social')
                ->where('config_type', 'url')
                ->whereNotNull('config_value')
                ->where('config_value', '!=', '')
                ->count();
            $socialCount = $socialConfigs;

            // Recent Blog Posts
            $recentBlogs = Blog::with(['category', 'createdBy'])
                ->latest()
                ->take(5)
                ->get();

            // Recent Comments
            $recentComments = BlogComment::with(['blog', 'user'])
                ->latest()
                ->take(5)
                ->get();

            return view('admin.pages.dashboard.dashboard', compact(
                'totalBlogs',
                'publishedBlogs',
                'draftBlogs',
                'totalPages',
                'activePages',
                'inactivePages',
                'totalComments',
                'approvedComments',
                'pendingComments',
                'totalCategories',
                'activeCategories',
                'totalTags',
                'activeTags',
                'socialCount',
                'recentBlogs',
                'recentComments'
            ));
        } catch (Exception $exception) {
            return errorResponse($exception->getMessage());
        }
    }
}
