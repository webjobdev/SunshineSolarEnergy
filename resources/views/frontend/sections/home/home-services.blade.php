<!-- Home Services Section Start -->
<section class="home-services-section">
    <div class="container">
        <div class="home-services-header">
            <div class="section-title">
                <h3 class="wow fadeInUp">What We Do</h3>
                <h2 class="text-anime">Our Solar Services</h2>
            </div>
            <a href="{{ route('services') }}" class="btn-view-link">
                View All Services <i class="fa-solid fa-arrow-right"></i>
            </a>
        </div>

        <div class="row g-4">
            @foreach($services as $service)
                <div class="col-lg-4 col-md-6">
                    <div class="home-service-card wow fadeInUp" data-wow-delay="{{ $loop->iteration * 0.08 }}s">
                        <a href="{{ route('service.single', $service->slug) }}" class="service-card-link"
                            aria-label="{{ $service->name }}"></a>

                        <div class="service-card-image">
                            @if($service->thumbnail_url)
                                <img src="{{ $service->thumbnail_url }}" alt="{{ $service->name }}" loading="lazy">
                            @else
                                <div class="service-placeholder">
                                    <i class="fa-solid fa-solar-panel"></i>
                                </div>
                            @endif
                        </div>

                        <div class="service-card-body">
                            <h3 class="service-card-title">{{ $service->name }}</h3>

                            @if($service->excerpt)
                                <p class="service-card-desc">
                                    {{ Str::limit(strip_tags($service->excerpt), 100) }}
                                </p>
                            @endif

                            <span class="service-card-more">
                                Learn More
                                <i class="fa-solid fa-arrow-right"></i>
                            </span>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
<!-- Home Services Section End -->

@push('styles')
    <style>
        .home-services-section {
            padding: 70px 0;
            background: #fff;
        }

        .home-services-header {
            display: flex;
            align-items: flex-end;
            justify-content: space-between;
            gap: 20px;
            margin-bottom: 40px;
            flex-wrap: wrap;
        }

        .home-services-header .section-title h3 {
            color: #28a745;
            font-size: 14px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1.2px;
            margin: 0 0 10px;
        }

        .home-services-header .section-title h2 {
            font-size: 32px;
            font-weight: 700;
            color: #1a1a1a;
            margin: 0;
            letter-spacing: -0.5px;
        }

        /* -------- Service Card -------- */
        .home-service-card {
            position: relative;
            background: #fff;
            border: 1px solid #f1f1f1;
            border-radius: 16px;
            overflow: hidden;
            height: 100%;
            display: flex;
            flex-direction: column;
            transition: transform 0.3s ease, box-shadow 0.3s ease, border-color 0.3s ease;
            box-shadow: 0 2px 12px rgba(0, 0, 0, 0.04);
        }

        .home-service-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 14px 30px rgba(0, 0, 0, 0.09);
            border-color: #d6efde;
        }

        .service-card-link {
            position: absolute;
            inset: 0;
            z-index: 3;
        }

        .service-card-image {
            position: relative;
            aspect-ratio: 16 / 10;
            background: #f8f9fa;
            overflow: hidden;
        }

        .service-card-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
            display: block;
        }

        .home-service-card:hover .service-card-image img {
            transform: scale(1.06);
        }

        .service-placeholder {
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #f0fdf4 0%, #e6f4ea 100%);
        }

        .service-placeholder i {
            font-size: 48px;
            color: #28a745;
            opacity: 0.55;
        }

        .service-card-body {
            padding: 22px 22px 24px;
            display: flex;
            flex-direction: column;
            flex: 1;
        }

        .service-card-title {
            font-size: 19px;
            font-weight: 700;
            color: #1a1a1a;
            line-height: 1.35;
            margin: 0 0 10px;
            transition: color 0.2s;
        }

        .home-service-card:hover .service-card-title {
            color: #28a745;
        }

        .service-card-desc {
            font-size: 14px;
            line-height: 1.65;
            color: #666;
            margin: 0 0 16px;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            flex: 1;
        }

        .service-card-more {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            font-size: 13px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: #28a745;
            margin-top: auto;
            transition: gap 0.2s;
        }

        .service-card-more i {
            font-size: 11px;
            transition: transform 0.2s;
        }

        .home-service-card:hover .service-card-more {
            gap: 10px;
        }

        .home-service-card:hover .service-card-more i {
            transform: translateX(3px);
        }

        /* -------- Responsive -------- */
        @media (max-width: 991px) {
            .home-services-section {
                padding: 50px 0;
            }

            .home-services-header .section-title h2 {
                font-size: 26px;
            }
        }

        @media (max-width: 575px) {
            .home-services-section {
                padding: 40px 0;
            }

            .home-services-header .section-title h2 {
                font-size: 22px;
            }

            .service-card-body {
                padding: 18px;
            }

            .service-card-title {
                font-size: 17px;
            }
        }
    </style>
@endpush