<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Admin\Page;
use App\Models\Admin\Product;
use App\Models\Admin\ProductBrand;
use App\Models\Admin\ProductCategory;
use App\Models\Admin\Service;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;

class HomeController extends Controller
{
    /**
     * Show the home page view.
     *
     * @method GET
     *
     * @url /
     */
    public function index(): View
    {
        $pages = Page::where('status', 'active')
            ->select('id', 'page_name', 'slug', 'meta_title', 'meta_description', 'status')
            ->get();

        $homePage = Page::where('slug', 'home')
            ->where('status', 'active')
            ->first();

        return view('frontend.home', compact('pages', 'homePage'));
    }

    /**
     * Show the about page view.
     *
     * @method GET
     *
     * @url /about
     */
    public function about(): View
    {
        $pages = Page::where('status', 'active')->get();
        $aboutPage = Page::where('slug', 'about')->where('status', 'active')->first();

        $aboutData = [
            'subtitle' => 'About Us',
            'title' => 'About Green Energy Solar',
            'description1' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.',
            'description2' => 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium.',
            'features' => [
                'Solar Inverter Setup',
                'Battery Storage Solutions',
                'Solar Material Financing',
                '24 X 7 Call & Chat Support',
                'Proven Track Record',
                'Customer-Centric Approach',
            ],
        ];

        $whyChooseData = [
            'subtitle' => 'Why Choose Us',
            'title' => 'Providing Solar Energy Solutions',
            'items' => [
                ['title' => 'Efficiency & Power', 'icon' => 'icon-whyus-1.svg', 'image' => 'whyus-1.jpg', 'description' => 'Ut ut eros risus. In luctus fringilla augue.', 'delay' => '0.25s'],
                ['title' => 'Trust & Warranty', 'icon' => 'icon-whyus-2.svg', 'image' => 'whyus-2.jpg', 'description' => 'Ut ut eros risus. In luctus fringilla augue.', 'delay' => '0.5s'],
                ['title' => 'High Quality Work', 'icon' => 'icon-whyus-3.svg', 'image' => 'whyus-3.jpg', 'description' => 'Ut ut eros risus. In luctus fringilla augue.', 'delay' => '0.75s'],
                ['title' => '24*7 Support', 'icon' => 'icon-whyus-4.svg', 'image' => 'whyus-4.jpg', 'description' => 'Ut ut eros risus. In luctus fringilla augue.', 'delay' => '1.0s'],
            ],
        ];

        $projectsData = [
            'subtitle' => 'Latest Project',
            'title' => 'Our Latest Projects',
            'items' => [
                ['title' => 'Photon Fusion', 'category' => 'Solar Power', 'image' => 'project-1.jpg', 'delay' => '0.25s'],
                ['title' => 'LuxSolar Dynamics', 'category' => 'Wind Energy', 'image' => 'project-2.jpg', 'delay' => '0.5s'],
                ['title' => 'HelioHarbor Dynamics', 'category' => 'Geothermal Energy', 'image' => 'project-3.jpg', 'delay' => '0.75s'],
                ['title' => 'SolarLoom Energy', 'category' => 'Solar Power', 'image' => 'project-4.jpg', 'delay' => '1.0s'],
            ],
        ];

        $testimonialData = [
            'subtitle' => 'Testimonials',
            'title' => 'Words From Our Customer',
            'items' => [
                ['name' => 'John Doe', 'role' => 'Customer', 'image' => 'author-1.jpg', 'rating' => 5, 'quote' => 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem.'],
                ['name' => 'Arita Benson', 'role' => 'Customer', 'image' => 'author-2.jpg', 'rating' => 5, 'quote' => 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem.'],
                ['name' => 'W. S. Gilbert', 'role' => 'Customer', 'image' => 'author-3.jpg', 'rating' => 5, 'quote' => 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem.'],
            ],
        ];

        $teamData = [
            'subtitle' => 'Our Team',
            'title' => 'Our Best Experts',
            'members' => [
                ['name' => 'John Doe', 'position' => 'Solar Engineer', 'image' => 'team-1.jpg', 'delay' => '0.25s'],
                ['name' => 'Arita Benson', 'position' => 'Solar Engineer', 'image' => 'team-2.jpg', 'delay' => '0.5s'],
                ['name' => 'W. S. Gilbert', 'position' => 'Solar Engineer', 'image' => 'team-3.jpg', 'delay' => '0.75s'],
                ['name' => 'Alpa Silva', 'position' => 'Solar Engineer', 'image' => 'team-4.jpg', 'delay' => '1.0s'],
            ],
        ];

        return view('frontend.about', compact(
            'pages',
            'aboutPage',
            'aboutData',
            'whyChooseData',
            'projectsData',
            'testimonialData',
            'teamData'
        ));
    }

        /**
     * Show the services page view.
     *
     * @method GET
     *
     * @url /services
     */
    public function services(): View
    {
        try {
            $pages = Page::where('status', 'active')->get();

            $servicesPage = Page::where('slug', 'services')
                ->where('status', 'active')
                ->first();

            $services = Service::active()
                ->orderBy('sort_order')
                ->orderBy('id', 'desc')
                ->get();

            return view('frontend.services', compact('pages', 'servicesPage', 'services'));
        } catch (Exception $exception) {
            abort(500, $exception->getMessage());
        }
    }

    /**
     * Show service single page.
     *
     * @method GET
     *
     * @url /service-single/{slug?}
     */
    public function serviceSingle(?string $slug = null): View
    {
        try {
            $pages = Page::where('status', 'active')->get();

            if (!$slug) {
                $firstService = Service::active()->orderBy('sort_order')->first();
                if (!$firstService) {
                    abort(404, 'No services available.');
                }
                return redirect()->route('service.single', $firstService->slug);
            }

            $service = Service::where('slug', $slug)
                ->where('status', 'active')
                ->firstOrFail();

            $allServices = Service::active()
                ->orderBy('sort_order')
                ->orderBy('id', 'desc')
                ->get();

            $relatedServices = Service::active()
                ->where('id', '!=', $service->id)
                ->orderBy('sort_order')
                ->limit(3)
                ->get();

            return view('frontend.service-single', compact('pages', 'service', 'allServices', 'relatedServices'));
        } catch (Exception $exception) {
            abort(404, 'Service not found.');
        }
    }
    /**
     * Get service benefits.
     */
    private function getServiceBenefits(?string $slug): array
    {
        return [
            ['icon' => 'icon-benefits-1.svg', 'title' => 'Renewable Energy', 'description' => 'Ut ut eros risus.'],
            ['icon' => 'icon-benefits-2.svg', 'title' => 'Energy Saving', 'description' => 'Ut ut eros risus.'],
            ['icon' => 'icon-benefits-3.svg', 'title' => 'Easy Installation', 'description' => 'Ut ut eros risus.'],
            ['icon' => 'icon-benefits-4.svg', 'title' => 'Energy Solution', 'description' => 'Ut ut eros risus.'],
            ['icon' => 'icon-benefits-5.svg', 'title' => 'Technical Support', 'description' => 'Ut ut eros risus.'],
            ['icon' => 'icon-benefits-6.svg', 'title' => 'Solar Maintenance', 'description' => 'Ut ut eros risus.'],
        ];
    }

    /**
     * Get service FAQs.
     */
    private function getServiceFaqs(): array
    {
        return [
            ['question' => 'Understanding Renewable Energy: A Beginners Guide?', 'answer' => 'Elit duis tristique sollicitudin nibh.', 'active' => true],
            ['question' => 'The Basics of Tidal and Wave Energy?', 'answer' => 'Elit duis tristique sollicitudin nibh.', 'active' => false],
            ['question' => 'Educating for a Sustainable Future?', 'answer' => 'Elit duis tristique sollicitudin nibh.', 'active' => false],
            ['question' => 'Staying Informed: Resources and Further Reading?', 'answer' => 'Elit duis tristique sollicitudin nibh.', 'active' => false],
        ];
    }

    /**
     * Show products page with filters and pagination.
     *
     * @method GET
     *
     * @url /products
     */
    public function products(Request $request): View
    {
        $pages = Page::where('status', 'active')->get();
        $productsPage = Page::where('slug', 'products')->where('status', 'active')->first();

        $products = $this->getFilteredProducts($request);
        $categories = $this->getCategoriesWithCounts();
        $brands = $this->getBrandsWithCounts();

        return view('frontend.products', compact('pages', 'productsPage', 'products', 'categories', 'brands'));
    }

    /**
     * Show product single page.
     *
     * @method GET
     *
     * @url /product/{slug}
     */
    public function productSingle(?string $slug = null): View
    {
        $pages = Page::where('status', 'active')->get();

        $product = Product::with(['brand', 'category', 'galleries'])
            ->where('slug', $slug)
            ->where('status', 'active')
            ->firstOrFail();

        $relatedProducts = Product::with(['brand', 'category'])
            ->where('status', 'active')
            ->where('id', '!=', $product->id)
            ->where(function ($query) use ($product) {
                $query->where('category_id', $product->category_id)
                    ->orWhere('brand_id', $product->brand_id);
            })
            ->orderBy('sort_order')
            ->limit(4)
            ->get();

        return view('frontend.product-single', compact('pages', 'product', 'relatedProducts'));
    }

    /**
     * AJAX endpoint for product filters, sort, and pagination.
     *
     * @method GET
     * @url /products/filter
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function productsFilter(Request $request): \Illuminate\Http\JsonResponse
    {
        try {
            $products = $this->getFilteredProducts($request);
            $html = view('frontend.sections.products-grid', compact('products'))->render();

            return response()->json([
                'status'       => true,
                'html'         => $html,
                'total'        => $products->total(),
                'first_item'   => $products->firstItem() ?? 0,
                'last_item'    => $products->lastItem() ?? 0,
                'current_page' => $products->currentPage(),
                'last_page'    => $products->lastPage(),
                'sort'         => $request->input('sort', 'newest'),
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status'  => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Get filtered products with pagination from database.
     *
     * @param Request $request
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    private function getFilteredProducts(Request $request)
    {
        $query = Product::with(['brand', 'category'])->where('status', 'active');

        // Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('short_description', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        // Categories
        if ($request->filled('categories')) {
            $query->whereIn('category_id', (array) $request->categories);
        }

        // Brands
        if ($request->filled('brands')) {
            $query->whereIn('brand_id', (array) $request->brands);
        }

        // ✅ SORTING — works for every case
        switch ($request->input('sort')) {
            case 'price_low':
                $query->orderByRaw('price IS NULL, price ASC');
                break;
            case 'price_high':
                $query->orderByRaw('price IS NULL, price DESC');
                break;
            case 'popular':
                $query->orderBy('sort_order', 'asc')->orderBy('id', 'desc');
                break;
            case 'newest':
            default:
                $query->orderBy('id', 'desc');
                break;
        }

        return $query->paginate(9)->withQueryString();
    }

    /**
     * Get active categories with product counts.
     *
     * @return Collection
     */
    private function getCategoriesWithCounts()
    {
        return ProductCategory::where('status', 'active')
            ->withCount(['products' => function ($query) {
                $query->where('status', 'active');
            }])
            ->orderBy('sort_order')
            ->get();
    }

    /**
     * Get active brands with product counts.
     *
     * @return Collection
     */
    private function getBrandsWithCounts()
    {
        return ProductBrand::where('status', 'active')
            ->withCount(['products' => function ($query) {
                $query->where('status', 'active');
            }])
            ->orderBy('sort_order')
            ->get();
    }

    /**
     * Show contact page.
     *
     * @method GET
     *
     * @url /contact
     */
    public function contact(): View
    {
        $pages = Page::where('status', 'active')->get();
        $contactPage = Page::where('slug', 'contact')->where('status', 'active')->first();

        $contactData = [
            'subtitle' => 'Contact Details',
            'title' => 'Happy to Answer All Your Questions',
            'form_subtitle' => 'Contact Now',
            'form_title' => 'Get In Touch With Us',
            'map_embed' => '<iframe src="https://www.google.com/maps/embed?pb=!1m16!1m12!1m3!1d56481.31329163797!2d-82.30112043759952!3d27.776444959332093!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!2m1!1sUnited%20States%20solar!5e0!3m2!1sen!2sin!4v1706008331370!5m2!1sen!2sin" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>',
            'items' => [
                ['title' => 'Our Addresses:', 'details' => '123, Lorem Ipsum, City, Country', 'icon' => 'icon-location.svg', 'image' => 'location-img.jpg', 'delay' => '0.25s'],
                ['title' => 'Emails:', 'details' => 'info@domainname.com', 'icon' => 'icon-mail.svg', 'image' => 'email-img.jpg', 'delay' => '0.5s'],
                ['title' => 'Phones:', 'details' => '(+0) 123 456 789', 'icon' => 'icon-phone.svg', 'image' => 'phone-img.jpg', 'delay' => '0.75s'],
                ['title' => 'Follow Us:', 'details' => 'social', 'icon' => 'icon-follow.svg', 'image' => 'follow-img.jpg', 'delay' => '1.0s'],
            ],
        ];

        return view('frontend.contact', compact('pages', 'contactPage', 'contactData'));
    }

    /**
     * Submit contact form.
     *
     * @method POST
     *
     * @url /contact/submit
     */
    public function submitContact(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors(),
            ], 422);
        }

        try {
            return response()->json([
                'status' => true,
                'message' => 'Thank you for contacting us. We will get back to you soon!',
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Unable to send message. Please try again later.',
            ], 500);
        }
    }

    /**
     * Show privacy policy page.
     *
     * @method GET
     *
     * @url /privacy-policy
     */
    public function privacyPolicy(): View
    {
        return $this->renderLegalPage('privacy-policy', 'Privacy Policy', 'privacy');
    }

    /**
     * Show terms & conditions page.
     *
     * @method GET
     *
     * @url /terms-conditions
     */
    public function termsConditions(): View
    {
        return $this->renderLegalPage('terms-conditions', 'Terms & Conditions', 'terms');
    }

    /**
     * Show disclaimer page.
     *
     * @method GET
     *
     * @url /disclaimer
     */
    public function disclaimer(): View
    {
        return $this->renderLegalPage('disclaimer', 'Disclaimer', 'disclaimer');
    }

    /**
     * Show refund policy page.
     *
     * @method GET
     *
     * @url /refund-policy
     */
    public function refundPolicy(): View
    {
        return $this->renderLegalPage('refund-policy', 'Refund & Cancellation Policy', 'refund');
    }

    /**
     * Render a legal page.
     */
    private function renderLegalPage(string $slug, string $title, string $pageType): View
    {
        $pages = Page::where('status', 'active')->get();
        $legalPage = Page::where('slug', $slug)->where('status', 'active')->first();

        return view('frontend.legal', compact('pages', 'legalPage', 'pageType', 'title'));
    }

    /**
     * Show FAQ page.
     *
     * @method GET
     *
     * @url /faq
     */
    public function faq(): View
    {
        $pages = Page::where('status', 'active')->get();
        $faqPage = Page::where('slug', 'faq')->where('status', 'active')->first();

        $faqCategories = [
            ['slug' => 'general', 'name' => 'General'],
            ['slug' => 'installation', 'name' => 'Installation'],
            ['slug' => 'maintenance', 'name' => 'Maintenance'],
            ['slug' => 'savings', 'name' => 'Savings & Benefits'],
        ];

        $faqData = [
            'subtitle' => 'Frequently Asked Questions',
            'title' => 'Find Answers to Your Questions',
            'description' => 'Browse our most commonly asked questions.',
            'items' => [
                ['id' => 1, 'question' => 'Understanding Renewable Energy?', 'answer' => 'Elit duis tristique sollicitudin nibh.', 'category' => 'general', 'active' => true],
                ['id' => 2, 'question' => 'The Basics of Tidal and Wave Energy?', 'answer' => 'Elit duis tristique sollicitudin nibh.', 'category' => 'general', 'active' => false],
                ['id' => 3, 'question' => 'Educating for a Sustainable Future?', 'answer' => 'Elit duis tristique sollicitudin nibh.', 'category' => 'installation', 'active' => false],
                ['id' => 4, 'question' => 'Staying Informed: Resources?', 'answer' => 'Elit duis tristique sollicitudin nibh.', 'category' => 'maintenance', 'active' => false],
                ['id' => 5, 'question' => 'How Much Can I Save?', 'answer' => 'Elit duis tristique sollicitudin nibh.', 'category' => 'savings', 'active' => false],
            ],
        ];

        return view('frontend.faq', compact('pages', 'faqPage', 'faqData', 'faqCategories'));
    }
}
