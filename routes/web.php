<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\BlogCategoryController;
use App\Http\Controllers\Admin\BlogCommentController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\BlogTagController;
use App\Http\Controllers\Admin\CustomerReviewController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\LegalPageController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\ProductBrandController;
use App\Http\Controllers\Admin\ProductCategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\WebsiteConfigController;
use App\Http\Controllers\Frontend\HomeController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     dd('home page');
// });
Route::middleware('guest')->group(function () {
    Route::get('admin/login', [AuthController::class, 'login'])->name('admin.login');
    Route::post('admin/login', [AuthController::class, 'authenticate'])->name('admin.login.authenticate');
});
Route::middleware('auth')->group(function () {
    Route::get('admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::post('admin/logout', [AuthController::class, 'logout'])->name('admin.logout');
});
Route::prefix('admin/page')->middleware('auth')->group(function () {
    Route::get('/', [PageController::class, 'index'])->name('admin.page');
    Route::get('/create', [PageController::class, 'create'])->name('admin.page.create');
    Route::post('/', [PageController::class, 'store'])->name('admin.page.store');
    Route::get('/edit/{id}', [PageController::class, 'edit'])->name('admin.page.edit');
    Route::put('/update/{id}', [PageController::class, 'update'])->name('admin.page.update');
    Route::delete('/delete/{id}', [PageController::class, 'destroy'])->name('admin.page.delete');
    Route::post('/generate-slug', [PageController::class, 'generateSlug'])->name('admin.page.generate.slug');
});

Route::prefix('admin')->middleware('auth')->group(function () {
    // Blog Main Routes
    Route::prefix('blog')->group(function () {
        Route::get('/', [BlogController::class, 'index'])->name('admin.blog');
        Route::get('/create', [BlogController::class, 'create'])->name('admin.blog.create');
        Route::post('/', [BlogController::class, 'store'])->name('admin.blog.store');
        Route::get('/edit/{id}', [BlogController::class, 'edit'])->name('admin.blog.edit');
        Route::put('/update/{id}', [BlogController::class, 'update'])->name('admin.blog.update');
        Route::delete('/delete/{id}', [BlogController::class, 'destroy'])->name('admin.blog.delete');
        Route::post('/generate-slug', [BlogController::class, 'generateSlug'])->name('admin.blog.generate-slug');
        Route::post('/toggle-status/{id}', [BlogController::class, 'toggleStatus'])->name('admin.blog.toggle-status');
        Route::get('/show/{id}', [BlogController::class, 'show'])->name('admin.blog.show');
    });

    // Blog Category Routes
    Route::prefix('blog/category')->group(function () {
        Route::get('/', [BlogCategoryController::class, 'index'])->name('admin.blog.category');
        Route::get('/create', [BlogCategoryController::class, 'create'])->name('admin.blog.category.create');
        Route::post('/', [BlogCategoryController::class, 'store'])->name('admin.blog.category.store');
        Route::get('/edit/{id}', [BlogCategoryController::class, 'edit'])->name('admin.blog.category.edit');
        Route::put('/update/{id}', [BlogCategoryController::class, 'update'])->name('admin.blog.category.update');
        Route::delete('/delete/{id}', [BlogCategoryController::class, 'destroy'])->name('admin.blog.category.delete');
        Route::post('/generate-slug', [BlogCategoryController::class, 'generateSlug'])->name('admin.blog.category.generate-slug');
    });

    // Blog Tag Routes
    Route::prefix('blog/tag')->group(function () {
        Route::get('/', [BlogTagController::class, 'index'])->name('admin.blog.tag');
        Route::get('/create', [BlogTagController::class, 'create'])->name('admin.blog.tag.create');
        Route::post('/', [BlogTagController::class, 'store'])->name('admin.blog.tag.store');
        Route::get('/edit/{id}', [BlogTagController::class, 'edit'])->name('admin.blog.tag.edit');
        Route::put('/update/{id}', [BlogTagController::class, 'update'])->name('admin.blog.tag.update');
        Route::delete('/delete/{id}', [BlogTagController::class, 'destroy'])->name('admin.blog.tag.delete');
        Route::post('/generate-slug', [BlogTagController::class, 'generateSlug'])->name('admin.blog.tag.generate-slug');
    });

    // Blog Comment Routes
    Route::prefix('blog/comment')->group(function () {
        Route::get('/', [BlogCommentController::class, 'index'])->name('admin.blog.comment');
        Route::post('/', [BlogCommentController::class, 'store'])->name('admin.blog.comment.store');
        Route::get('/edit/{id}', [BlogCommentController::class, 'edit'])->name('admin.blog.comment.edit');
        Route::put('/update/{id}', [BlogCommentController::class, 'update'])->name('admin.blog.comment.update');
        Route::delete('/delete/{id}', [BlogCommentController::class, 'destroy'])->name('admin.blog.comment.delete');
        Route::post('/approve/{id}', [BlogCommentController::class, 'approve'])->name('admin.blog.comment.approve');
        Route::post('/reject/{id}', [BlogCommentController::class, 'reject'])->name('admin.blog.comment.reject');
        Route::post('/bulk-action', [BlogCommentController::class, 'bulkAction'])->name('admin.blog.comment.bulk-action');
    });

    // Website Configuration Routes
    Route::prefix('config')->group(function () {
        Route::get('/', [WebsiteConfigController::class, 'index'])->name('admin.config');
        Route::get('/create', [WebsiteConfigController::class, 'create'])->name('admin.config.create');
        Route::post('/', [WebsiteConfigController::class, 'store'])->name('admin.config.store');
        Route::get('/edit/{id}', [WebsiteConfigController::class, 'edit'])->name('admin.config.edit');
        Route::put('/update/{id}', [WebsiteConfigController::class, 'update'])->name('admin.config.update');
        Route::delete('/delete/{id}', [WebsiteConfigController::class, 'destroy'])->name('admin.config.delete');
        Route::post('/upload-image', [WebsiteConfigController::class, 'uploadImage'])->name('admin.config.upload-image');
        Route::post('/bulk-update', [WebsiteConfigController::class, 'bulkUpdate'])->name('admin.config.bulk-update');
        Route::post('/reset/{id}', [WebsiteConfigController::class, 'reset'])->name('admin.config.reset');
        Route::post('/remove-image', [WebsiteConfigController::class, 'removeImage'])->name('admin.config.remove-image');
        Route::get('/images/{group}', [WebsiteConfigController::class, 'getImages'])->name('admin.config.images');
        Route::post('/cleanup-images', [WebsiteConfigController::class, 'cleanupImages'])->name('admin.config.cleanup-images');
    });

    // Product Brands Routes
    Route::prefix('product/brand')->group(function () {
        Route::get('/', [ProductBrandController::class, 'index'])->name('admin.product.brand');
        Route::get('/create', [ProductBrandController::class, 'create'])->name('admin.product.brand.create');
        Route::post('/', [ProductBrandController::class, 'store'])->name('admin.product.brand.store');
        Route::get('/edit/{id}', [ProductBrandController::class, 'edit'])->name('admin.product.brand.edit');
        Route::put('/update/{id}', [ProductBrandController::class, 'update'])->name('admin.product.brand.update');
        Route::delete('/delete/{id}', [ProductBrandController::class, 'destroy'])->name('admin.product.brand.delete');
        Route::post('/generate-slug', [ProductBrandController::class, 'generateSlug'])->name('admin.product.brand.generate-slug');
    });

    // Product Categories Routes
    Route::prefix('product/category')->group(function () {
        Route::get('/', [ProductCategoryController::class, 'index'])->name('admin.product.category');
        Route::get('/create', [ProductCategoryController::class, 'create'])->name('admin.product.category.create');
        Route::post('/', [ProductCategoryController::class, 'store'])->name('admin.product.category.store');
        Route::get('/edit/{id}', [ProductCategoryController::class, 'edit'])->name('admin.product.category.edit');
        Route::put('/update/{id}', [ProductCategoryController::class, 'update'])->name('admin.product.category.update');
        Route::delete('/delete/{id}', [ProductCategoryController::class, 'destroy'])->name('admin.product.category.delete');
        Route::post('/generate-slug', [ProductCategoryController::class, 'generateSlug'])->name('admin.product.category.generate-slug');
    });

    // Products Routes
    Route::prefix('product')->group(function () {
        Route::get('/', [ProductController::class, 'index'])->name('admin.product');
        Route::get('/create', [ProductController::class, 'create'])->name('admin.product.create');
        Route::post('/', [ProductController::class, 'store'])->name('admin.product.store');
        Route::get('/edit/{id}', [ProductController::class, 'edit'])->name('admin.product.edit');
        Route::put('/update/{id}', [ProductController::class, 'update'])->name('admin.product.update');
        Route::delete('/delete/{id}', [ProductController::class, 'destroy'])->name('admin.product.delete');
        Route::post('/generate-slug', [ProductController::class, 'generateSlug'])->name('admin.product.generate-slug');
    });

    // Services Routes
    Route::prefix('service')->group(function () {
        Route::get('/', [ServiceController::class, 'index'])->name('admin.service');
        Route::get('/create', [ServiceController::class, 'create'])->name('admin.service.create');
        Route::post('/', [ServiceController::class, 'store'])->name('admin.service.store');
        Route::get('/edit/{id}', [ServiceController::class, 'edit'])->name('admin.service.edit');
        Route::put('/update/{id}', [ServiceController::class, 'update'])->name('admin.service.update');
        Route::delete('/delete/{id}', [ServiceController::class, 'destroy'])->name('admin.service.delete');
        Route::post('/generate-slug', [ServiceController::class, 'generateSlug'])->name('admin.service.generate-slug');
    });

    // Customer Reviews Routes
    Route::prefix('customer-review')->group(function () {
        Route::get('/', [CustomerReviewController::class, 'index'])->name('admin.customer-review');
        Route::get('/create', [CustomerReviewController::class, 'create'])->name('admin.customer-review.create');
        Route::post('/', [CustomerReviewController::class, 'store'])->name('admin.customer-review.store');
        Route::get('/edit/{id}', [CustomerReviewController::class, 'edit'])->name('admin.customer-review.edit');
        Route::put('/update/{id}', [CustomerReviewController::class, 'update'])->name('admin.customer-review.update');
        Route::delete('/delete/{id}', [CustomerReviewController::class, 'destroy'])->name('admin.customer-review.delete');
    });


    // Legal Pages Routes
    Route::prefix('legal-page')->group(function () {
        Route::get('/', [LegalPageController::class, 'index'])->name('admin.legal-page');
        Route::get('/edit/{type}', [LegalPageController::class, 'edit'])->name('admin.legal-page.edit');
        Route::put('/update/{type}', [LegalPageController::class, 'update'])->name('admin.legal-page.update');
    });
});

// ============================= Frontend ============================================

// Home Routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [HomeController::class, 'about'])->name('about');
Route::get('/services', [HomeController::class, 'services'])->name('services');
Route::get('/service-single/{slug?}', [HomeController::class, 'serviceSingle'])->name('service.single');
Route::get('/products/filter', [HomeController::class, 'productsFilter'])->name('products.filter');
Route::get('/products', [HomeController::class, 'products'])->name('products');
Route::get('/product/{slug}', [HomeController::class, 'productSingle'])->name('product.single');
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');
Route::post('/contact/submit', [HomeController::class, 'submitContact'])->name('contact.submit');

Route::get('/privacy-policy', [HomeController::class, 'privacyPolicy'])->name('legal.privacy');
Route::get('/terms-conditions', [HomeController::class, 'termsConditions'])->name('legal.terms');
Route::get('/disclaimer', [HomeController::class, 'disclaimer'])->name('legal.disclaimer');
Route::get('/refund-policy', [HomeController::class, 'refundPolicy'])->name('legal.refund');
Route::get('/faq', [HomeController::class, 'faq'])->name('faq');

// Route::get('/home-video', [HomeController::class, 'video'])->name('home.video');
// Route::get('/home-slider', [HomeController::class, 'slider'])->name('home.slider');
// Route::get('/home-2', [HomeController::class, 'index2'])->name('home2');
// Route::get('/home-2-video', [HomeController::class, 'video2'])->name('home2.video');
// Route::get('/home-2-slider', [HomeController::class, 'slider2'])->name('home2.slider');
// Route::get('/home-3', [HomeController::class, 'index3'])->name('home3');
// Route::get('/home-3-video', [HomeController::class, 'video3'])->name('home3.video');
// Route::get('/home-3-slider', [HomeController::class, 'slider3'])->name('home3.slider');

// About
// Route::get('/about', [HomeController::class, 'about'])->name('about');

// Services/
// Route::get('/services', [HomeController::class, 'services'])->name('services');
// Route::get('/service-single', [HomeController::class, 'serviceSingle'])->name('service.single');

// Projects
// Route::get('/projects', [HomeController::class, 'projects'])->name('projects');
// Route::get('/project-single', [HomeController::class, 'projectSingle'])->name('project.single');

// Blog
// Route::get('/blog', [HomeController::class, 'blog'])->name('blog');
// Route::get('/blog-single', [HomeController::class, 'blogSingle'])->name('blog.single');

// Team
// Route::get('/team', [HomeController::class, 'team'])->name('team');
// Route::get('/team-single', [HomeController::class, 'teamSingle'])->name('team.single');

// Other Pages
// Route::get('/faq', [HomeController::class, 'faq'])->name('faq');
// Route::get('/contact', [HomeController::class, 'contact'])->name('contact');
// Route::get('/book-now', [HomeController::class, 'bookNow'])->name('book.now');
// Route::get('/404', [HomeController::class, 'error404'])->name('404');

// Calculator
// Route::post('/calculate', [CalculatorController::class, 'calculate'])->name('calculator.calculate');
// ---------------
// Products Routes
// Route::prefix('products')->group(function () {
//     Route::get('/', [ProductController::class, 'index']);
//     Route::get('/new', [ProductController::class, 'newProducts']);
//     Route::get('/trending', [ProductController::class, 'trendingProducts']);
//     Route::get('/home', [ProductController::class, 'homeProducts']);
//     Route::get('/brand/{slug}', [ProductController::class, 'byBrand']);
//     Route::get('/category/{slug}', [ProductController::class, 'byCategory']);
//     Route::get('/{slug}', [ProductController::class, 'show']);
// });

// // Services Routes
// Route::prefix('services')->group(function () {
//     Route::get('/', [ServiceController::class, 'index']);
//     Route::get('/{slug}', [ServiceController::class, 'show']);
// });

// // Customer Reviews Routes
// Route::get('/customer-reviews', [CustomerReviewController::class, 'index']);

// Legal Pages Routes
// Route::prefix('legal-pages')->group(function () {
//     Route::get('/', [LegalPageController::class, 'index']);
//     Route::get('/{type}', [LegalPageController::class, 'show']);
// });