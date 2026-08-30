<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Admin\Page;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;

class HomeController extends Controller
{
    /**
     * Show the home page view.
     *
     * @method GET
     * @url /
     *
     * @return View
     */
    public function index(): View
    {
        // Get active pages for menu/navigation
        $pages = Page::where('status', 'active')
            ->select('id', 'page_name', 'slug', 'meta_title', 'meta_description', 'status')
            ->get();

        // Get home page specific content
        $homePage = Page::where('slug', 'home')
            ->where('status', 'active')
            ->first();

        return view('frontend.home', compact('pages', 'homePage'));
    }

    /**
     * @method GET
     * @url /about
     * Show the about page view.
     */
    public function about(): View
    {
        $pages = Page::where('status', 'active')->get();
        $aboutPage = Page::where('slug', 'about')->where('status', 'active')->first();

        // About page data (can come from database or config)
        $aboutData = [
            'subtitle' => 'About Us',
            'title' => 'About Green Energy Solar',
            'description1' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled.',
            'description2' => 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.',
            'features' => [
                'Solar Inverter Setup',
                'Battery Storage Solutions',
                'Solar Material Financing',
                '24 X 7 Call & Chat Support',
                'Proven Track Record',
                'Customer-Centric Approach'
            ]
        ];

        $whyChooseData = [
            'subtitle' => 'Why Choose Us',
            'title' => 'Providing Solar Energy Solutions',
            'items' => [
                [
                    'title' => 'Efficiency & Power',
                    'icon' => 'icon-whyus-1.svg',
                    'image' => 'whyus-1.jpg',
                    'description' => 'Ut ut eros risus. In luctus fringilla augue, eget ultricies purus. Sed mauris a nisl.',
                    'delay' => '0.25s'
                ],
                [
                    'title' => 'Trust & Warranty',
                    'icon' => 'icon-whyus-2.svg',
                    'image' => 'whyus-2.jpg',
                    'description' => 'Ut ut eros risus. In luctus fringilla augue, eget ultricies purus. Sed mauris a nisl.',
                    'delay' => '0.5s'
                ],
                [
                    'title' => 'High Quality Work',
                    'icon' => 'icon-whyus-3.svg',
                    'image' => 'whyus-3.jpg',
                    'description' => 'Ut ut eros risus. In luctus fringilla augue, eget ultricies purus. Sed mauris a nisl.',
                    'delay' => '0.75s'
                ],
                [
                    'title' => '24*7 Support',
                    'icon' => 'icon-whyus-4.svg',
                    'image' => 'whyus-4.jpg',
                    'description' => 'Ut ut eros risus. In luctus fringilla augue, eget ultricies purus. Sed mauris a nisl.',
                    'delay' => '1.0s'
                ]
            ]
        ];

        $projectsData = [
            'subtitle' => 'Latest Project',
            'title' => 'Our Latest Projects',
            'items' => [
                [
                    'title' => 'Photon Fusion',
                    'category' => 'Solar Power',
                    'image' => 'project-1.jpg',
                    'delay' => '0.25s'
                ],
                [
                    'title' => 'LuxSolar Dynamics',
                    'category' => 'Wind Energy',
                    'image' => 'project-2.jpg',
                    'delay' => '0.5s'
                ],
                [
                    'title' => 'HelioHarbor Dynamics',
                    'category' => 'Geothermal Energy',
                    'image' => 'project-3.jpg',
                    'delay' => '0.75s'
                ],
                [
                    'title' => 'SolarLoom Energy',
                    'category' => 'Solar Power',
                    'image' => 'project-4.jpg',
                    'delay' => '1.0s'
                ]
            ]
        ];

        $testimonialData = [
            'subtitle' => 'Testimonials',
            'title' => 'Words From Our Customer',
            'items' => [
                [
                    'name' => 'John Doe',
                    'role' => 'Customer',
                    'image' => 'author-1.jpg',
                    'rating' => 5,
                    'quote' => 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.'
                ],
                [
                    'name' => 'Arita Benson',
                    'role' => 'Customer',
                    'image' => 'author-2.jpg',
                    'rating' => 5,
                    'quote' => 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.'
                ],
                [
                    'name' => 'W. S. Gilbert',
                    'role' => 'Customer',
                    'image' => 'author-3.jpg',
                    'rating' => 5,
                    'quote' => 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.'
                ]
            ]
        ];

        $teamData = [
            'subtitle' => 'Our Team',
            'title' => 'Our Best Experts',
            'members' => [
                [
                    'name' => 'John Doe',
                    'position' => 'Solar Engineer',
                    'image' => 'team-1.jpg',
                    'delay' => '0.25s'
                ],
                [
                    'name' => 'Arita Benson',
                    'position' => 'Solar Engineer',
                    'image' => 'team-2.jpg',
                    'delay' => '0.5s'
                ],
                [
                    'name' => 'W. S. Gilbert',
                    'position' => 'Solar Engineer',
                    'image' => 'team-3.jpg',
                    'delay' => '0.75s'
                ],
                [
                    'name' => 'Alpa Silva',
                    'position' => 'Solar Engineer',
                    'image' => 'team-4.jpg',
                    'delay' => '1.0s'
                ]
            ]
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
     * @method GET
     * @url /services
     * Show the services page view.
     */
    public function services(): View
    {
        $pages = Page::where('status', 'active')->get();
        $servicesPage = Page::where('slug', 'services')->where('status', 'active')->first();

        // Services data (can come from database)
        $servicesData = [
            'subtitle' => 'Our Services',
            'title' => 'What We Offer',
            'items' => [
                [
                    'title' => 'Solar Maintenance',
                    'description' => 'Aenean mattis mauris turpis, quis porta magna aliquam eu. Nulla consectetur.',
                    'image' => 'service-1.jpg',
                    'icon' => 'icon-service-1.svg',
                    'delay' => '0.25s',
                    'slug' => 'solar-maintenance'
                ],
                [
                    'title' => 'Energy Saving Devices',
                    'description' => 'Aenean mattis mauris turpis, quis porta magna aliquam eu. Nulla consectetur.',
                    'image' => 'service-2.jpg',
                    'icon' => 'icon-service-2.svg',
                    'delay' => '0.5s',
                    'slug' => 'energy-saving-devices'
                ],
                [
                    'title' => 'Solar Solutions',
                    'description' => 'Aenean mattis mauris turpis, quis porta magna aliquam eu. Nulla consectetur.',
                    'image' => 'service-3.jpg',
                    'icon' => 'icon-service-3.svg',
                    'delay' => '0.75s',
                    'slug' => 'solar-solutions'
                ],
                [
                    'title' => 'Solar PV Systems',
                    'description' => 'Aenean mattis mauris turpis, quis porta magna aliquam eu. Nulla consectetur.',
                    'image' => 'service-4.jpg',
                    'icon' => 'icon-service-4.svg',
                    'delay' => '1.0s',
                    'slug' => 'solar-pv-systems'
                ],
                [
                    'title' => 'Hybrid Energy',
                    'description' => 'Aenean mattis mauris turpis, quis porta magna aliquam eu. Nulla consectetur.',
                    'image' => 'service-5.jpg',
                    'icon' => 'icon-service-5.svg',
                    'delay' => '1.25s',
                    'slug' => 'hybrid-energy'
                ],
                [
                    'title' => 'Renewable Energy',
                    'description' => 'Aenean mattis mauris turpis, quis porta magna aliquam eu. Nulla consectetur.',
                    'image' => 'service-6.jpg',
                    'icon' => 'icon-service-6.svg',
                    'delay' => '1.5s',
                    'slug' => 'renewable-energy'
                ]
            ]
        ];

        $whyChooseData = [
            'subtitle' => 'Why Choose Us',
            'title' => 'Providing Solar Energy Solutions',
            'items' => [
                [
                    'title' => 'Efficiency & Power',
                    'icon' => 'icon-whyus-1.svg',
                    'image' => 'whyus-1.jpg',
                    'description' => 'Ut ut eros risus. In luctus fringilla augue, eget ultricies purus. Sed mauris a nisl.',
                    'delay' => '0.25s'
                ],
                [
                    'title' => 'Trust & Warranty',
                    'icon' => 'icon-whyus-2.svg',
                    'image' => 'whyus-2.jpg',
                    'description' => 'Ut ut eros risus. In luctus fringilla augue, eget ultricies purus. Sed mauris a nisl.',
                    'delay' => '0.5s'
                ],
                [
                    'title' => 'High Quality Work',
                    'icon' => 'icon-whyus-3.svg',
                    'image' => 'whyus-3.jpg',
                    'description' => 'Ut ut eros risus. In luctus fringilla augue, eget ultricies purus. Sed mauris a nisl.',
                    'delay' => '0.75s'
                ],
                [
                    'title' => '24*7 Support',
                    'icon' => 'icon-whyus-4.svg',
                    'image' => 'whyus-4.jpg',
                    'description' => 'Ut ut eros risus. In luctus fringilla augue, eget ultricies purus. Sed mauris a nisl.',
                    'delay' => '1.0s'
                ]
            ]
        ];

        return view('frontend.services', compact(
            'pages',
            'servicesPage',
            'servicesData',
            'whyChooseData'
        ));
    }

    /**
     * @method GET
     * @url /service-single/{slug?}
     * Show service single page.
     */
    public function serviceSingle(string $slug = null): View
    {
        $pages = Page::where('status', 'active')->get();

        // Get service from database or use dummy data
        $service = $this->getServiceBySlug($slug);

        // Get all services for sidebar
        $allServices = $this->getAllServices();

        // Get service benefits
        $service->benefits = $this->getServiceBenefits($slug);

        // Get service FAQs
        $service->faqs = $this->getServiceFaqs($slug);

        return view('frontend.service-single', compact(
            'pages',
            'service',
            'allServices'
        ));
    }

    /**
     * Get service by slug.
     */
    private function getServiceBySlug(?string $slug): object
    {
        $services = [
            'solar-maintenance' => (object) [
                'title' => 'Solar Maintenance',
                'slug' => 'solar-maintenance',
                'featured_image' => 'service-feature-img.jpg',
                'content' => '<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p><p>but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>',
                'why_us' => 'but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages.',
                'video_url' => 'https://www.youtube.com/watch?v=2JNMGesMC2Y',
                'video_thumbnail' => 'video-bg.jpg',
                'benefits_title' => 'Benefits of Solar Energy',
                'feature_image' => 'planning.jpg',
                'feature_title' => 'Planning & Strategy',
                'feature_description' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been standard dummy text ever since the 1500s.',
                'feature_list' => [
                    'Research beyond the business plan',
                    'Marketing options and rates',
                    'The ability to turnaround consulting',
                    'It was popularised in the 1960s with the.'
                ],
                'faq_title' => 'Frequently Asked Questions',
                'meta_title' => 'Solar Maintenance Services - Professional Solar Panel Maintenance',
                'meta_description' => 'Professional solar maintenance services including cleaning, inspections, and repairs to ensure optimal performance of your solar energy system.'
            ],
            'energy-saving-devices' => (object) [
                'title' => 'Energy Saving Devices',
                'slug' => 'energy-saving-devices',
                'featured_image' => 'service-feature-img.jpg',
                'content' => '<p>Energy saving devices help reduce your carbon footprint and save money on utility bills. Our range of innovative devices includes smart thermostats, energy monitors, and efficient lighting solutions.</p><p>These devices are designed to optimize energy consumption and provide real-time data on your energy usage patterns.</p>',
                'why_us' => 'Our energy saving devices are designed with cutting-edge technology to provide maximum efficiency and cost savings.',
                'video_url' => 'https://www.youtube.com/watch?v=2JNMGesMC2Y',
                'video_thumbnail' => 'video-bg.jpg',
                'benefits_title' => 'Benefits of Energy Saving Devices',
                'feature_image' => 'planning.jpg',
                'feature_title' => 'Smart Energy Solutions',
                'feature_description' => 'Our energy saving devices are engineered to deliver optimal performance while reducing energy consumption.',
                'feature_list' => [
                    'Smart home integration',
                    'Real-time energy monitoring',
                    'Automated energy management',
                    'Remote control capabilities'
                ],
                'faq_title' => 'Frequently Asked Questions',
                'meta_title' => 'Energy Saving Devices - Reduce Your Energy Consumption',
                'meta_description' => 'Discover our range of energy saving devices including smart thermostats, energy monitors, and LED lighting solutions.'
            ],
            // Add more services as needed
        ];

        // Default service if slug not found
        $defaultService = (object) [
            'title' => 'Solar Solutions',
            'slug' => 'solar-solutions',
            'featured_image' => 'service-feature-img.jpg',
            'content' => '<p>Complete solar solutions for residential and commercial properties. We design, install, and maintain solar energy systems that meet your specific energy needs.</p>',
            'why_us' => 'We provide comprehensive solar solutions with proven expertise and quality service.',
            'video_url' => 'https://www.youtube.com/watch?v=2JNMGesMC2Y',
            'video_thumbnail' => 'video-bg.jpg',
            'benefits_title' => 'Benefits of Solar Solutions',
            'feature_image' => 'planning.jpg',
            'feature_title' => 'Custom Solar Solutions',
            'feature_description' => 'Tailored solar solutions designed to meet your specific energy requirements.',
            'feature_list' => [
                'Custom system design',
                'Professional installation',
                'Ongoing maintenance',
                'Performance monitoring'
            ],
            'faq_title' => 'Frequently Asked Questions',
            'meta_title' => 'Solar Solutions - Complete Solar Energy Systems',
            'meta_description' => 'Comprehensive solar solutions including custom design, installation, and maintenance.'
        ];

        return $services[$slug] ?? $defaultService;
    }

    /**
     * Get all services for sidebar.
     */
    private function getAllServices(): array
    {
        return [
            (object) ['title' => 'Solar Maintenance', 'slug' => 'solar-maintenance'],
            (object) ['title' => 'Energy Saving Devices', 'slug' => 'energy-saving-devices'],
            (object) ['title' => 'Solar Solutions', 'slug' => 'solar-solutions'],
            (object) ['title' => 'Solar PV Systems', 'slug' => 'solar-pv-systems'],
            (object) ['title' => 'Hybrid Energy', 'slug' => 'hybrid-energy'],
            (object) ['title' => 'Renewable Energy', 'slug' => 'renewable-energy'],
        ];
    }

    /**
     * Get service benefits.
     */
    private function getServiceBenefits(?string $slug): array
    {
        $benefits = [
            'solar-maintenance' => [
                [
                    'icon' => 'icon-benefits-1.svg',
                    'title' => 'Renewable Energy',
                    'description' => 'Ut ut eros risus. In luctus fringilla augue, eget ultricies purus.'
                ],
                [
                    'icon' => 'icon-benefits-2.svg',
                    'title' => 'Energy Saving',
                    'description' => 'Ut ut eros risus. In luctus fringilla augue, eget ultricies purus.'
                ],
                [
                    'icon' => 'icon-benefits-3.svg',
                    'title' => 'Easy Installation',
                    'description' => 'Ut ut eros risus. In luctus fringilla augue, eget ultricies purus.'
                ],
                [
                    'icon' => 'icon-benefits-4.svg',
                    'title' => 'Energy Solution',
                    'description' => 'Ut ut eros risus. In luctus fringilla augue, eget ultricies purus.'
                ],
                [
                    'icon' => 'icon-benefits-5.svg',
                    'title' => 'Technical Support',
                    'description' => 'Ut ut eros risus. In luctus fringilla augue, eget ultricies purus.'
                ],
                [
                    'icon' => 'icon-benefits-6.svg',
                    'title' => 'Solar Maintenance',
                    'description' => 'Ut ut eros risus. In luctus fringilla augue, eget ultricies purus.'
                ]
            ]
        ];

        return $benefits[$slug] ?? $this->getDefaultBenefits();
    }

    /**
     * Get default benefits.
     */
    private function getDefaultBenefits(): array
    {
        return [
            [
                'icon' => 'icon-benefits-1.svg',
                'title' => 'Renewable Energy',
                'description' => 'Ut ut eros risus. In luctus fringilla augue, eget ultricies purus.'
            ],
            [
                'icon' => 'icon-benefits-2.svg',
                'title' => 'Energy Saving',
                'description' => 'Ut ut eros risus. In luctus fringilla augue, eget ultricies purus.'
            ],
            [
                'icon' => 'icon-benefits-3.svg',
                'title' => 'Easy Installation',
                'description' => 'Ut ut eros risus. In luctus fringilla augue, eget ultricies purus.'
            ],
            [
                'icon' => 'icon-benefits-4.svg',
                'title' => 'Energy Solution',
                'description' => 'Ut ut eros risus. In luctus fringilla augue, eget ultricies purus.'
            ],
            [
                'icon' => 'icon-benefits-5.svg',
                'title' => 'Technical Support',
                'description' => 'Ut ut eros risus. In luctus fringilla augue, eget ultricies purus.'
            ],
            [
                'icon' => 'icon-benefits-6.svg',
                'title' => 'Solar Maintenance',
                'description' => 'Ut ut eros risus. In luctus fringilla augue, eget ultricies purus.'
            ]
        ];
    }

    /**
     * Get service FAQs.
     */
    private function getServiceFaqs(?string $slug): array
    {
        return [
            [
                'question' => 'Understanding Renewable Energy: A Beginners Guide ?',
                'answer' => 'Elit duis tristique sollicitudin nibh sit amet commodo nulla facilisi. Tempus imperdiet nulla malesuada pellentesque elit. Suspendisse in est ante in nibh mauris. Sagittis purus sit amet volutpat consequat. Sociis natoque penatibus et magnis. Ornare suspendisse sed nisi lacus sed viverra.',
                'active' => true
            ],
            [
                'question' => 'The Basics of Tidal and Wave Energy?',
                'answer' => 'Elit duis tristique sollicitudin nibh sit amet commodo nulla facilisi. Tempus imperdiet nulla malesuada pellentesque elit. Suspendisse in est ante in nibh mauris. Sagittis purus sit amet volutpat consequat. Sociis natoque penatibus et magnis. Ornare suspendisse sed nisi lacus sed viverra.',
                'active' => false
            ],
            [
                'question' => 'Educating for a Sustainable Future?',
                'answer' => 'Elit duis tristique sollicitudin nibh sit amet commodo nulla facilisi. Tempus imperdiet nulla malesuada pellentesque elit. Suspendisse in est ante in nibh mauris. Sagittis purus sit amet volutpat consequat. Sociis natoque penatibus et magnis. Ornare suspendisse sed nisi lacus sed viverra.',
                'active' => false
            ],
            [
                'question' => 'Staying Informed: Resources and Further Reading on Renewable Energy?',
                'answer' => 'Elit duis tristique sollicitudin nibh sit amet commodo nulla facilisi. Tempus imperdiet nulla malesuada pellentesque elit. Suspendisse in est ante in nibh mauris. Sagittis purus sit amet volutpat consequat. Sociis natoque penatibus et magnis. Ornare suspendisse sed nisi lacus sed viverra.',
                'active' => false
            ]
        ];
    }

    /**
     * Show products page with filters and pagination.
     */
    public function products(Request $request): View
    {
        $pages = Page::where('status', 'active')->get();
        $productsPage = Page::where('slug', 'products')->where('status', 'active')->first();

        // Get products with filters
        $products = $this->getFilteredProducts($request);

        // Get categories with counts
        $categories = $this->getCategoriesWithCounts();

        // Get brands with counts
        $brands = $this->getBrandsWithCounts();

        return view('frontend.products', compact(
            'pages',
            'productsPage',
            'products',
            'categories',
            'brands'
        ));
    }

    /**
     * Show product single page.
     */
    public function productSingle(string $slug = null): View
    {
        $pages = Page::where('status', 'active')->get();

        // Get product data
        $product = $this->getProductBySlug($slug);

        // Get related products
        $relatedProducts = $this->getRelatedProducts($slug);

        return view('frontend.product-single', compact(
            'pages',
            'product',
            'relatedProducts'
        ));
    }

    /**
     * Get filtered products with pagination.
     */
    private function getFilteredProducts(Request $request): object
    {
        $perPage = 9;

        // Start with all products
        $products = collect($this->getAllProductsData());

        // Apply search filter
        if ($request->has('search') && !empty($request->search)) {
            $search = strtolower($request->search);
            $products = $products->filter(function ($product) use ($search) {
                return str_contains(strtolower($product['name']), $search) ||
                    str_contains(strtolower($product['description'] ?? ''), $search);
            });
        }

        // Apply category filter
        if ($request->has('categories') && !empty($request->categories)) {
            $categories = $request->categories;
            $products = $products->filter(function ($product) use ($categories) {
                return in_array($product['category_id'], $categories);
            });
        }

        // Apply brand filter
        if ($request->has('brands') && !empty($request->brands)) {
            $brands = $request->brands;
            $products = $products->filter(function ($product) use ($brands) {
                return in_array($product['brand_id'], $brands);
            });
        }

        // Apply price filter
        if ($request->has('min_price') && !empty($request->min_price)) {
            $products = $products->filter(function ($product) use ($request) {
                return ($product['sale_price'] ?? $product['price']) >= $request->min_price;
            });
        }
        if ($request->has('max_price') && !empty($request->max_price)) {
            $products = $products->filter(function ($product) use ($request) {
                return ($product['sale_price'] ?? $product['price']) <= $request->max_price;
            });
        }

        // Apply rating filter
        if ($request->has('ratings') && !empty($request->ratings)) {
            $ratings = $request->ratings;
            $products = $products->filter(function ($product) use ($ratings) {
                return in_array(round($product['rating'] ?? 0), $ratings);
            });
        }

        // Apply sorting
        if ($request->has('sort')) {
            switch ($request->sort) {
                case 'price_low':
                    $products = $products->sortBy(function ($p) {
                        return $p['sale_price'] ?? $p['price'];
                    });
                    break;
                case 'price_high':
                    $products = $products->sortByDesc(function ($p) {
                        return $p['sale_price'] ?? $p['price'];
                    });
                    break;
                case 'popular':
                    $products = $products->sortByDesc('rating');
                    break;
                case 'newest':
                default:
                    // Already in order
                    break;
            }
        }

        // Paginate the results
        $currentPage = $request->get('page', 1);
        $paginatedItems = $products->forPage($currentPage, $perPage);

        // Create paginator
        return new \Illuminate\Pagination\LengthAwarePaginator(
            $paginatedItems,
            $products->count(),
            $perPage,
            $currentPage,
            ['path' => $request->url(), 'query' => $request->query()]
        );
    }

    /**
     * Get all products data.
     */
    private function getAllProductsData(): array
    {
        return [
            [
                'id' => 1,
                'name' => 'Solar Panel 400W Mono',
                'slug' => 'solar-panel-400w-mono',
                'sku' => 'SP-400-M',
                'image' => 'project-1.jpg',
                'main_image' => 'project-1.jpg',
                'gallery' => ['project-1.jpg', 'project-2.jpg', 'project-3.jpg'],
                'price' => 299.99,
                'sale_price' => 249.99,
                'badge' => 'Sale',
                'badge_type' => 'sale',
                'description' => '<p>High-efficiency monocrystalline solar panel with 400W power output. Perfect for residential and commercial installations.</p><p>Features advanced cell technology for maximum energy conversion even in low-light conditions.</p>',
                'short_description' => 'High-efficiency 400W monocrystalline solar panel with advanced cell technology.',
                'category_id' => 1,
                'category_name' => 'Solar Panels',
                'brand_id' => 1,
                'brand_name' => 'SolarTech',
                'rating' => 4.8,
                'reviews_count' => 127,
                'specifications' => [
                    ['label' => 'Power Output', 'value' => '400W'],
                    ['label' => 'Efficiency', 'value' => '21.2%'],
                    ['label' => 'Cell Type', 'value' => 'Monocrystalline'],
                    ['label' => 'Dimensions', 'value' => '67.7 x 44.6 x 1.2 inches'],
                    ['label' => 'Warranty', 'value' => '25 Years'],
                ],
                'reviews' => [
                    ['author' => 'John Smith', 'date' => 'Jan 15, 2024', 'rating' => 5, 'content' => 'Excellent panel! Great efficiency and easy to install.'],
                    ['author' => 'Maria Johnson', 'date' => 'Dec 20, 2023', 'rating' => 4, 'content' => 'Good quality panel, works well with my system.'],
                ]
            ],
            [
                'id' => 2,
                'name' => 'Solar Inverter 5kW',
                'slug' => 'solar-inverter-5kw',
                'sku' => 'SI-5K-H',
                'image' => 'project-2.jpg',
                'main_image' => 'project-2.jpg',
                'gallery' => ['project-2.jpg', 'project-4.jpg'],
                'price' => 899.99,
                'sale_price' => null,
                'badge' => 'New',
                'badge_type' => 'new',
                'description' => '<p>High-performance 5kW hybrid solar inverter with advanced MPPT technology. Compatible with both grid-tied and off-grid systems.</p>',
                'short_description' => '5kW hybrid solar inverter with advanced MPPT technology for maximum efficiency.',
                'category_id' => 2,
                'category_name' => 'Inverters',
                'brand_id' => 1,
                'brand_name' => 'SolarTech',
                'rating' => 4.6,
                'reviews_count' => 89,
                'specifications' => [
                    ['label' => 'Power Output', 'value' => '5kW'],
                    ['label' => 'Input Voltage', 'value' => '120-450V'],
                    ['label' => 'Efficiency', 'value' => '98.2%'],
                    ['label' => 'Type', 'value' => 'Hybrid'],
                    ['label' => 'Warranty', 'value' => '10 Years'],
                ],
                'reviews' => [
                    ['author' => 'Mike Wilson', 'date' => 'Feb 1, 2024', 'rating' => 5, 'content' => 'Great inverter, works perfectly with my solar array.'],
                ]
            ],
            [
                'id' => 3,
                'name' => 'Lithium Battery 10kWh',
                'slug' => 'lithium-battery-10kwh',
                'sku' => 'LB-10K-L',
                'image' => 'project-3.jpg',
                'main_image' => 'project-3.jpg',
                'gallery' => ['project-3.jpg'],
                'price' => 2499.99,
                'sale_price' => 2199.99,
                'badge' => 'Sale',
                'badge_type' => 'sale',
                'description' => '<p>High-capacity 10kWh lithium battery storage system for solar energy storage. Ideal for home backup and off-grid applications.</p>',
                'short_description' => '10kWh lithium battery storage system with high capacity and long lifespan.',
                'category_id' => 3,
                'category_name' => 'Batteries',
                'brand_id' => 2,
                'brand_name' => 'EcoBatt',
                'rating' => 4.9,
                'reviews_count' => 56,
                'specifications' => [
                    ['label' => 'Capacity', 'value' => '10kWh'],
                    ['label' => 'Voltage', 'value' => '48V'],
                    ['label' => 'Chemistry', 'value' => 'Lithium Iron Phosphate'],
                    ['label' => 'Cycle Life', 'value' => '6000 Cycles'],
                    ['label' => 'Warranty', 'value' => '10 Years'],
                ],
                'reviews' => [
                    ['author' => 'Emma Davis', 'date' => 'Jan 28, 2024', 'rating' => 5, 'content' => 'Excellent battery storage, reliable and long-lasting.'],
                ]
            ],
            // Add more products as needed...
        ];
    }

    /**
     * Get categories with product counts.
     */
    private function getCategoriesWithCounts(): array
    {
        $allProducts = $this->getAllProductsData();
        $categories = [];

        foreach ($allProducts as $product) {
            $catId = $product['category_id'];
            $catName = $product['category_name'];

            if (!isset($categories[$catId])) {
                $categories[$catId] = ['id' => $catId, 'name' => $catName, 'count' => 0];
            }
            $categories[$catId]['count']++;
        }

        return array_values($categories);
    }

    /**
     * Get brands with product counts.
     */
    private function getBrandsWithCounts(): array
    {
        $allProducts = $this->getAllProductsData();
        $brands = [];

        foreach ($allProducts as $product) {
            $brandId = $product['brand_id'];
            $brandName = $product['brand_name'];

            if (!isset($brands[$brandId])) {
                $brands[$brandId] = ['id' => $brandId, 'name' => $brandName, 'count' => 0];
            }
            $brands[$brandId]['count']++;
        }

        return array_values($brands);
    }

    /**
     * Get product by slug.
     */
    private function getProductBySlug(?string $slug): object
    {
        $allProducts = $this->getAllProductsData();

        // Find product by slug
        $productData = collect($allProducts)->firstWhere('slug', $slug);

        // Return default if not found
        if (!$productData) {
            $productData = $allProducts[0];
        }

        return (object) $productData;
    }

    /**
     * Get related products.
     */
    private function getRelatedProducts(?string $slug): array
    {
        $allProducts = $this->getAllProductsData();
        $product = collect($allProducts)->firstWhere('slug', $slug);

        if (!$product) {
            $product = $allProducts[0];
        }

        // Get products from same category
        $related = collect($allProducts)
            ->where('category_id', $product['category_id'])
            ->where('slug', '!=', $slug)
            ->take(4)
            ->toArray();

        // If not enough, add more from other categories
        if (count($related) < 4) {
            $extra = collect($allProducts)
                ->where('slug', '!=', $slug)
                ->whereNotIn('category_id', [$product['category_id']])
                ->take(4 - count($related))
                ->toArray();
            $related = array_merge($related, $extra);
        }

        return $related;
    }


    /**
     * @method GET
     * @url /contact
     * 
     * Show contact page.
     */
    public function contact(): View
    {
        $pages = Page::where('status', 'active')->get();
        $contactPage = Page::where('slug', 'contact')->where('status', 'active')->first();

        // Contact data
        $contactData = [
            'subtitle' => 'Contact Details',
            'title' => 'Happy to Answer All Your Questions',
            'form_subtitle' => 'Contact Now',
            'form_title' => 'Get In Touch With Us',
            'map_embed' => '<iframe src="https://www.google.com/maps/embed?pb=!1m16!1m12!1m3!1d56481.31329163797!2d-82.30112043759952!3d27.776444959332093!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!2m1!1sUnited%20States%20solar!5e0!3m2!1sen!2sin!4v1706008331370!5m2!1sen!2sin" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>',
            'items' => [
                [
                    'title' => 'Our Addresses:',
                    'details' => '123, Lorem Ipsum, Street no, City, Country 123456',
                    'icon' => 'icon-location.svg',
                    'image' => 'location-img.jpg',
                    'delay' => '0.25s'
                ],
                [
                    'title' => 'Emails:',
                    'details' => 'info@domainname.com<br> sales@domainname.com',
                    'icon' => 'icon-mail.svg',
                    'image' => 'email-img.jpg',
                    'delay' => '0.5s'
                ],
                [
                    'title' => 'Phones:',
                    'details' => '(+0) 123 456 789<br> (+1) 456 123 789',
                    'icon' => 'icon-phone.svg',
                    'image' => 'phone-img.jpg',
                    'delay' => '0.75s'
                ],
                [
                    'title' => 'Follow Us:',
                    'details' => 'social',
                    'icon' => 'icon-follow.svg',
                    'image' => 'follow-img.jpg',
                    'delay' => '1.0s'
                ]
            ]
        ];

        return view('frontend.contact', compact('pages', 'contactPage', 'contactData'));
    }

    /**
     * @method POST
     * @url /contact/submit
     * Submit contact form.
     */
    public function submitContact(Request $request): \Illuminate\Http\JsonResponse
    {
        // Validate request
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
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            // Get form data
            $data = $validator->validated();

            // Store in database (optional)
            // Contact::create($data);

            // Send email (optional)
            // Mail::to(setting('contact_email', 'info@domainname.com'))->send(new ContactFormMail($data));

            // Return success response
            return response()->json([
                'status' => true,
                'message' => 'Thank you for contacting us. We will get back to you soon!'
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Unable to send message. Please try again later.'
            ], 500);
        }
    }

     /**
     * @method GET
     * @url /privacy-policy
     * Show privacy policy page.
     */
    public function privacyPolicy(): View
    {
        $pages = Page::where('status', 'active')->get();
        $legalPage = Page::where('slug', 'privacy-policy')->where('status', 'active')->first();
        
        return view('frontend.legal', [
            'pages' => $pages,
            'legalPage' => $legalPage,
            'pageType' => 'privacy',
            'title' => 'Privacy Policy'
        ]);
    }

    /**
     * @method GET
     * @url /terms-conditions
     * Show terms & conditions page.
     */
    public function termsConditions(): View
    {
        $pages = Page::where('status', 'active')->get();
        $legalPage = Page::where('slug', 'terms-conditions')->where('status', 'active')->first();
        
        return view('frontend.legal', [
            'pages' => $pages,
            'legalPage' => $legalPage,
            'pageType' => 'terms',
            'title' => 'Terms & Conditions'
        ]);
    }

    /**
     * @method GET
     * @url /disclaimer
     * Show disclaimer page.
     */
    public function disclaimer(): View
    {
        $pages = Page::where('status', 'active')->get();
        $legalPage = Page::where('slug', 'disclaimer')->where('status', 'active')->first();
        
        return view('frontend.legal', [
            'pages' => $pages,
            'legalPage' => $legalPage,
            'pageType' => 'disclaimer',
            'title' => 'Disclaimer'
        ]);
    }

    /**
     * @method GET
     * @url /refund-policy
     * Show refund policy page.
     */
    public function refundPolicy(): View
    {
        $pages = Page::where('status', 'active')->get();
        $legalPage = Page::where('slug', 'refund-policy')->where('status', 'active')->first();
        
        return view('frontend.legal', [
            'pages' => $pages,
            'legalPage' => $legalPage,
            'pageType' => 'refund',
            'title' => 'Refund & Cancellation Policy'
        ]);
    }

     /**
     * @method GET
     * @url /faq
     * Show FAQ page.
     */
    public function faq(): View
    {
        $pages = Page::where('status', 'active')->get();
        $faqPage = Page::where('slug', 'faq')->where('status', 'active')->first();
        
        // FAQ Categories
        $faqCategories = [
            ['slug' => 'general', 'name' => 'General'],
            ['slug' => 'installation', 'name' => 'Installation'],
            ['slug' => 'maintenance', 'name' => 'Maintenance'],
            ['slug' => 'savings', 'name' => 'Savings & Benefits'],
            ['slug' => 'equipment', 'name' => 'Equipment'],
            ['slug' => 'regulatory', 'name' => 'Regulatory'],
            ['slug' => 'education', 'name' => 'Education'],
            ['slug' => 'resources', 'name' => 'Resources'],
        ];
        
        // FAQ Data
        $faqData = [
            'subtitle' => 'Frequently Asked Questions',
            'title' => 'Find Answers to Your Questions',
            'description' => 'Browse through our most commonly asked questions about solar energy, installation, and our services.',
            'items' => [
                [
                    'id' => 1,
                    'question' => 'Understanding Renewable Energy: A Beginners Guide ?',
                    'answer' => 'Elit duis tristique sollicitudin nibh sit amet commodo nulla facilisi. Tempus imperdiet nulla malesuada pellentesque elit. Suspendisse in est ante in nibh mauris. Sagittis purus sit amet volutpat consequat. Sociis natoque penatibus et magnis. Ornare suspendisse sed nisi lacus sed viverra.',
                    'category' => 'general',
                    'active' => true
                ],
                [
                    'id' => 2,
                    'question' => 'The Basics of Tidal and Wave Energy?',
                    'answer' => 'Elit duis tristique sollicitudin nibh sit amet commodo nulla facilisi. Tempus imperdiet nulla malesuada pellentesque elit. Suspendisse in est ante in nibh mauris. Sagittis purus sit amet volutpat consequat. Sociis natoque penatibus et magnis. Ornare suspendisse sed nisi lacus sed viverra.',
                    'category' => 'general',
                    'active' => false
                ],
                [
                    'id' => 3,
                    'question' => 'Educating for a Sustainable Future?',
                    'answer' => 'Elit duis tristique sollicitudin nibh sit amet commodo nulla facilisi. Tempus imperdiet nulla malesuada pellentesque elit. Suspendisse in est ante in nibh mauris. Sagittis purus sit amet volutpat consequat. Sociis natoque penatibus et magnis. Ornare suspendisse sed nisi lacus sed viverra.',
                    'category' => 'education',
                    'active' => false
                ],
                [
                    'id' => 4,
                    'question' => 'Staying Informed: Resources and Further Reading on Renewable Energy?',
                    'answer' => 'Elit duis tristique sollicitudin nibh sit amet commodo nulla facilisi. Tempus imperdiet nulla malesuada pellentesque elit. Suspendisse in est ante in nibh mauris. Sagittis purus sit amet volutpat consequat. Sociis natoque penatibus et magnis. Ornare suspendisse sed nisi lacus sed viverra.',
                    'category' => 'resources',
                    'active' => false
                ],
                [
                    'id' => 5,
                    'question' => 'Solar Panel Types: Choosing the Right Technology for Your Installation ?',
                    'answer' => 'Elit duis tristique sollicitudin nibh sit amet commodo nulla facilisi. Tempus imperdiet nulla malesuada pellentesque elit. Suspendisse in est ante in nibh mauris. Sagittis purus sit amet volutpat consequat. Sociis natoque penatibus et magnis. Ornare suspendisse sed nisi lacus sed viverra.',
                    'category' => 'installation',
                    'active' => false
                ],
                [
                    'id' => 6,
                    'question' => 'Installation Process Unveiled: What to Expect During Solar Panel Setup ?',
                    'answer' => 'Elit duis tristique sollicitudin nibh sit amet commodo nulla facilisi. Tempus imperdiet nulla malesuada pellentesque elit. Suspendisse in est ante in nibh mauris. Sagittis purus sit amet volutpat consequat. Sociis natoque penatibus et magnis. Ornare suspendisse sed nisi lacus sed viverra.',
                    'category' => 'installation',
                    'active' => false
                ],
                [
                    'id' => 7,
                    'question' => 'Permitting and Paperwork: Navigating the Regulatory Landscape for Solar?',
                    'answer' => 'Elit duis tristique sollicitudin nibh sit amet commodo nulla facilisi. Tempus imperdiet nulla malesuada pellentesque elit. Suspendisse in est ante in nibh mauris. Sagittis purus sit amet volutpat consequat. Sociis natoque penatibus et magnis. Ornare suspendisse sed nisi lacus sed viverra.',
                    'category' => 'regulatory',
                    'active' => false
                ],
                [
                    'id' => 8,
                    'question' => 'Solar Inverters: Understanding Their Role in Your System?',
                    'answer' => 'Elit duis tristique sollicitudin nibh sit amet commodo nulla facilisi. Tempus imperdiet nulla malesuada pellentesque elit. Suspendisse in est ante in nibh mauris. Sagittis purus sit amet volutpat consequat. Sociis natoque penatibus et magnis. Ornare suspendisse sed nisi lacus sed viverra.',
                    'category' => 'equipment',
                    'active' => false
                ],
                [
                    'id' => 9,
                    'question' => 'How Much Can I Save with Solar Energy?',
                    'answer' => 'Elit duis tristique sollicitudin nibh sit amet commodo nulla facilisi. Tempus imperdiet nulla malesuada pellentesque elit. Suspendisse in est ante in nibh mauris. Sagittis purus sit amet volutpat consequat. Sociis natoque penatibus et magnis. Ornare suspendisse sed nisi lacus sed viverra.',
                    'category' => 'savings',
                    'active' => false
                ],
                [
                    'id' => 10,
                    'question' => 'What Maintenance Does a Solar System Require?',
                    'answer' => 'Elit duis tristique sollicitudin nibh sit amet commodo nulla facilisi. Tempus imperdiet nulla malesuada pellentesque elit. Suspendisse in est ante in nibh mauris. Sagittis purus sit amet volutpat consequat. Sociis natoque penatibus et magnis. Ornare suspendisse sed nisi lacus sed viverra.',
                    'category' => 'maintenance',
                    'active' => false
                ],
                [
                    'id' => 11,
                    'question' => 'Is My Roof Suitable for Solar Panel Installation?',
                    'answer' => 'Elit duis tristique sollicitudin nibh sit amet commodo nulla facilisi. Tempus imperdiet nulla malesuada pellentesque elit. Suspendisse in est ante in nibh mauris. Sagittis purus sit amet volutpat consequat. Sociis natoque penatibus et magnis. Ornare suspendisse sed nisi lacus sed viverra.',
                    'category' => 'installation',
                    'active' => false
                ],
                [
                    'id' => 12,
                    'question' => 'What is the Lifespan of Solar Panels?',
                    'answer' => 'Elit duis tristique sollicitudin nibh sit amet commodo nulla facilisi. Tempus imperdiet nulla malesuada pellentesque elit. Suspendisse in est ante in nibh mauris. Sagittis purus sit amet volutpat consequat. Sociis natoque penatibus et magnis. Ornare suspendisse sed nisi lacus sed viverra.',
                    'category' => 'general',
                    'active' => false
                ]
            ]
        ];

        return view('frontend.faq', compact('pages', 'faqPage', 'faqData', 'faqCategories'));
    }
}
