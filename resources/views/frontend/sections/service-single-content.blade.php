@php
    $serviceName = $service->name ?? '';
    $serviceShort = $service->short_description ?? '';
    $serviceDesc = $service->description ?? '';
    $serviceImage = $service->thumbnail_url ?? null;
    $serviceExcerpt = $service->excerpt ?? '';
@endphp

<div class="page-service-single">
    <div class="container">

        <div class="service-back-row">
            <a href="{{ route('services') }}" class="back-link">
                <i class="fa-solid fa-arrow-left"></i>
                <span>Back to Services</span>
            </a>
        </div>

        <div class="row g-4">

            {{-- Main content --}}
            <div class="col-lg-8">

                <div class="service-main-card">

                    @if($serviceImage)
                        <div class="service-featured-image">
                            <img src="{{ $serviceImage }}" alt="{{ $serviceName }}">
                        </div>
                    @endif

                    <div class="service-body">
                        <h1 class="service-name">{{ $serviceName }}</h1>

                        @if($serviceShort)
                            <p class="service-short-desc">{{ $serviceShort }}</p>
                        @endif

                        @if($serviceDesc)
                            <div class="service-entry">
                                {!! $serviceDesc !!}
                            </div>
                        @endif

                        {{-- CTA --}}
                        <div class="service-cta">
                            <div class="cta-left">
                                <div class="cta-icon">
                                    <i class="fa-brands fa-whatsapp"></i>
                                </div>
                                <div class="cta-text">
                                    <strong>Need this service?</strong>
                                    <span>Talk to our team now</span>
                                </div>
                            </div>

                            <a href="{{ whatsappUrl('Hi, I am interested in your service: ' . $serviceName) }}"
                                target="_blank" rel="noopener" class="btn-enquire">
                                <i class="fa-brands fa-whatsapp"></i>
                                Enquire on WhatsApp
                            </a>
                        </div>

                        {{-- Share --}}
                        <div class="service-share">
                            <span class="share-label">Share this service</span>
                            <div class="share-buttons">
                                <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}"
                                    target="_blank" rel="noopener" aria-label="Facebook"><i
                                        class="fa-brands fa-facebook-f"></i></a>
                                <a href="https://twitter.com/intent/tweet?url={{ urlencode(url()->current()) }}"
                                    target="_blank" rel="noopener" aria-label="Twitter"><i
                                        class="fa-brands fa-twitter"></i></a>
                                <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ urlencode(url()->current()) }}"
                                    target="_blank" rel="noopener" aria-label="LinkedIn"><i
                                        class="fa-brands fa-linkedin-in"></i></a>
                                <a href="{{ whatsappUrl('Check out this service: ' . $serviceName . ' - ' . url()->current()) }}"
                                    target="_blank" rel="noopener" aria-label="WhatsApp"><i
                                        class="fa-brands fa-whatsapp"></i></a>
                            </div>
                        </div>

                    </div>

                </div>
            </div>

            {{-- Sidebar --}}
            <div class="col-lg-4">
                <div class="service-sidebar-wrap">

                    {{-- All services list --}}
                    @if(isset($allServices) && $allServices->count() > 0)
                        <div class="sidebar-card">
                            <h4 class="sidebar-title">
                                <i class="fa-solid fa-list-check"></i>
                                All Services
                            </h4>
                            <ul class="services-sidebar-list">
                                @foreach($allServices as $item)
                                    <li class="{{ $item->id === $service->id ? 'active' : '' }}">
                                        <a href="{{ route('service.single', $item->slug) }}">
                                            <span class="list-icon">
                                                <i class="fa-solid fa-chevron-right"></i>
                                            </span>
                                            <span class="list-text">{{ $item->name }}</span>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    {{-- Help CTA --}}
                    <div class="sidebar-card sidebar-cta-card">
                        <div class="cta-icon-lg">
                            <i class="fa-brands fa-whatsapp"></i>
                        </div>
                        <h4>Need Help?</h4>
                        <p>Get in touch with our experts for a free consultation.</p>

                        @if(configSetting('whatsapp_number'))
                            <a href="{{ whatsappUrl('Hi, I need help with a service.') }}" target="_blank" rel="noopener"
                                class="btn-sidebar-whatsapp">
                                <i class="fa-brands fa-whatsapp"></i>
                                Chat on WhatsApp
                            </a>
                        @endif

                        <a href="{{ route('contact') }}" class="btn-sidebar-outline">
                            <i class="fa-solid fa-envelope"></i>
                            Contact Us
                        </a>
                    </div>

                </div>
            </div>

        </div>

        {{-- Related Services --}}
        @if(isset($relatedServices) && $relatedServices->count() > 0)
            <div class="row mt-5">
                <div class="col-12">
                    <div class="related-services-header">
                        <span class="eyebrow">More from us</span>
                        <h2>Related Services</h2>
                    </div>

                    <div class="row g-4">
                        @foreach($relatedServices as $related)
                            <div class="col-lg-4 col-md-6">
                                <div class="service-item">
                                    <a href="{{ route('service.single', $related->slug) }}" class="service-box-link"
                                        aria-label="{{ $related->name }}"></a>

                                    <div class="service-image">
                                        @if($related->thumbnail_url)
                                            <img src="{{ $related->thumbnail_url }}" alt="{{ $related->name }}" loading="lazy">
                                        @else
                                            <img src="{{ asset('frontend/images/service-placeholder.jpg') }}"
                                                alt="{{ $related->name }}" loading="lazy">
                                        @endif
                                    </div>

                                    <div class="service-content">
                                        <h3>
                                            <a href="{{ route('service.single', $related->slug) }}">{{ $related->name }}</a>
                                        </h3>
                                        @if($related->excerpt)
                                            <p>{{ Str::limit($related->excerpt, 100) }}</p>
                                        @endif
                                        <span class="service-read-more">
                                            Learn More
                                            <i class="fa-solid fa-arrow-right"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @endif

    </div>
</div>

@push('styles')
    <style>
        /* =========================================================
       SERVICE SINGLE
       ========================================================= */
        .page-service-single {
            padding: 30px 0 60px;
            background: #fafbfc;
        }

        .service-back-row {
            margin-bottom: 20px;
        }

        .back-link {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            font-size: 14px;
            font-weight: 600;
            color: #666;
            background: #fff;
            border: 1px solid #f1f1f1;
            padding: 10px 18px;
            border-radius: 10px;
            text-decoration: none;
            transition: all 0.2s;
        }

        .back-link:hover {
            color: #28a745;
            border-color: #28a745;
            transform: translateX(-3px);
            box-shadow: 0 4px 12px rgba(40, 167, 69, 0.12);
        }

        /* -------- Main card -------- */
        .service-main-card {
            background: #fff;
            border: 1px solid #f1f1f1;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.04);
        }

        .service-featured-image {
            width: 100%;
            aspect-ratio: 16 / 9;
            background: #f8f9fa;
            overflow: hidden;
        }

        .service-featured-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }

        .service-body {
            padding: 32px;
        }

        .service-name {
            font-size: 30px;
            font-weight: 800;
            color: #1a1a1a;
            line-height: 1.25;
            margin: 0 0 14px;
            letter-spacing: -0.4px;
        }

        .service-short-desc {
            font-size: 16px;
            color: #666;
            line-height: 1.7;
            margin: 0 0 22px;
            padding-bottom: 22px;
            border-bottom: 1px solid #f0f0f0;
        }

        /* Rich HTML content */
        .service-entry {
            font-size: 15px;
            line-height: 1.85;
            color: #444;
        }

        .service-entry>*:first-child {
            margin-top: 0;
        }

        .service-entry>*:last-child {
            margin-bottom: 0;
        }

        .service-entry p {
            margin: 0 0 14px;
        }

        .service-entry h1,
        .service-entry h2,
        .service-entry h3,
        .service-entry h4 {
            color: #1a1a1a;
            font-weight: 700;
            margin: 24px 0 12px;
            line-height: 1.35;
        }

        .service-entry h1 {
            font-size: 26px;
        }

        .service-entry h2 {
            font-size: 22px;
        }

        .service-entry h3 {
            font-size: 19px;
        }

        .service-entry h4 {
            font-size: 17px;
        }

        .service-entry img {
            max-width: 100%;
            height: auto;
            border-radius: 10px;
            margin: 14px 0;
        }

        .service-entry ul,
        .service-entry ol {
            padding-left: 22px;
            margin: 0 0 14px;
        }

        .service-entry li {
            margin-bottom: 6px;
        }

        .service-entry blockquote {
            border-left: 4px solid #28a745;
            background: #f7fbf9;
            padding: 14px 20px;
            margin: 16px 0;
            border-radius: 6px;
            color: #555;
            font-style: italic;
        }

        .service-entry table {
            width: 100%;
            border-collapse: collapse;
            margin: 18px 0;
            font-size: 14px;
        }

        .service-entry table td,
        .service-entry table th {
            border: 1px solid #e5e5e5;
            padding: 10px 14px;
        }

        .service-entry table th {
            background: #f8f9fa;
            font-weight: 600;
            text-align: left;
        }

        .service-entry a {
            color: #28a745;
            text-decoration: underline;
        }

        /* -------- CTA box -------- */
        .service-cta {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            background: linear-gradient(135deg, #f0fdf4 0%, #e6f4ea 100%);
            border: 1px solid #d6efde;
            border-radius: 14px;
            padding: 20px 22px;
            margin-top: 30px;
            flex-wrap: wrap;
        }

        .cta-left {
            display: flex;
            align-items: center;
            gap: 14px;
        }

        .cta-icon {
            width: 46px;
            height: 46px;
            background: #25D366;
            color: #fff;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 22px;
            flex-shrink: 0;
        }

        .cta-text strong {
            display: block;
            font-size: 15px;
            font-weight: 700;
            color: #1a1a1a;
            margin-bottom: 2px;
        }

        .cta-text span {
            font-size: 13px;
            color: #666;
        }

        .btn-enquire {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            background: #25D366;
            color: #fff !important;
            padding: 13px 22px;
            border-radius: 10px;
            font-size: 14px;
            font-weight: 700;
            text-decoration: none;
            transition: all 0.25s ease;
            box-shadow: 0 6px 18px rgba(37, 211, 102, 0.28);
            border: none;
            white-space: nowrap;
        }

        .btn-enquire:hover {
            background: #128C7E;
            color: #fff !important;
            transform: translateY(-2px);
            box-shadow: 0 10px 26px rgba(37, 211, 102, 0.38);
        }

        .btn-enquire i {
            font-size: 18px;
        }

        /* -------- Share -------- */
        .service-share {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            padding-top: 22px;
            margin-top: 22px;
            border-top: 1px solid #f0f0f0;
            flex-wrap: wrap;
        }

        .share-label {
            font-size: 13px;
            color: #999;
            font-weight: 500;
        }

        .share-buttons {
            display: flex;
            gap: 8px;
        }

        .share-buttons a {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 38px;
            height: 38px;
            border-radius: 50%;
            background: #f5f5f5;
            color: #555;
            text-decoration: none;
            transition: all 0.2s;
            font-size: 14px;
        }

        .share-buttons a:hover {
            background: #28a745;
            color: #fff;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(40, 167, 69, 0.3);
        }

        /* =========================================================
       SIDEBAR
       ========================================================= */
        .service-sidebar-wrap {
            position: sticky;
            top: 20px;
            display: flex;
            flex-direction: column;
            gap: 16px;
        }

        .sidebar-card {
            background: #fff;
            border: 1px solid #f1f1f1;
            border-radius: 14px;
            padding: 22px;
            box-shadow: 0 2px 12px rgba(0, 0, 0, 0.04);
        }

        .sidebar-title {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 15px;
            font-weight: 700;
            color: #1a1a1a;
            margin: 0 0 14px;
            padding-bottom: 12px;
            border-bottom: 2px solid #f5f5f5;
        }

        .sidebar-title i {
            color: #28a745;
            font-size: 14px;
        }

        .services-sidebar-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .services-sidebar-list li {
            margin-bottom: 4px;
        }

        .services-sidebar-list li a {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px 12px;
            border-radius: 10px;
            color: #333;
            text-decoration: none;
            font-size: 14px;
            font-weight: 500;
            transition: all 0.2s;
            line-height: 1.4;
        }

        .services-sidebar-list li a:hover {
            background: #f7fbf9;
            color: #28a745;
            transform: translateX(3px);
        }

        .services-sidebar-list li.active a {
            background: #e6f4ea;
            color: #28a745;
            font-weight: 700;
        }

        .services-sidebar-list .list-icon {
            width: 18px;
            text-align: center;
            color: #ccc;
            font-size: 11px;
            transition: color 0.2s;
            flex-shrink: 0;
        }

        .services-sidebar-list li a:hover .list-icon,
        .services-sidebar-list li.active .list-icon {
            color: #28a745;
        }

        .services-sidebar-list .list-text {
            flex: 1;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

      /* -------- Sidebar CTA (white + green theme) -------- */
.sidebar-cta-card {
    text-align: center;
    background: linear-gradient(180deg, #f0fdf4 0%, #e6f4ea 100%);
    border: 1px solid #d6efde;
    color: #1a1a1a;
}

.sidebar-cta-card .cta-icon-lg {
    width: 64px;
    height: 64px;
    margin: 0 auto 14px;
    background: #25D366;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 30px;
    color: #fff;
    box-shadow: 0 6px 20px rgba(37, 211, 102, 0.35);
    position: relative;
}

/* Subtle pulsing ring around WhatsApp icon */
.sidebar-cta-card .cta-icon-lg::before {
    content: '';
    position: absolute;
    inset: -6px;
    border-radius: 50%;
    border: 2px solid rgba(37, 211, 102, 0.3);
    animation: pulse-ring 2s ease-out infinite;
}

@keyframes pulse-ring {
    0% {
        transform: scale(0.9);
        opacity: 1;
    }
    100% {
        transform: scale(1.3);
        opacity: 0;
    }
}

.sidebar-cta-card h4 {
    font-size: 18px;
    font-weight: 700;
    color: #1a1a1a;
    margin: 0 0 8px;
}

.sidebar-cta-card p {
    font-size: 13px;
    color: #666;
    margin: 0 0 18px;
    line-height: 1.6;
}

.btn-sidebar-whatsapp,
.btn-sidebar-outline {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    width: 100%;
    padding: 13px;
    border-radius: 10px;
    font-size: 14px;
    font-weight: 700;
    text-decoration: none;
    transition: all 0.2s;
    margin-bottom: 10px;
    border: none;
    cursor: pointer;
}

.btn-sidebar-whatsapp {
    background: #25D366;
    color: #fff !important;
    box-shadow: 0 6px 18px rgba(37, 211, 102, 0.35);
}

.btn-sidebar-whatsapp:hover {
    background: #128C7E;
    color: #fff !important;
    transform: translateY(-2px);
    box-shadow: 0 10px 24px rgba(37, 211, 102, 0.45);
}

.btn-sidebar-whatsapp i {
    font-size: 17px;
}

.btn-sidebar-outline {
    background: #fff;
    color: #1a1a1a !important;
    border: 1.5px solid #d6efde;
    margin-bottom: 0;
}

.btn-sidebar-outline:hover {
    background: #e6f4ea;
    border-color: #25D366;
    color: #128C7E !important;
    transform: translateY(-2px);
}

.btn-sidebar-outline i {
    color: #25D366;
    font-size: 14px;
    transition: color 0.2s;
}

.btn-sidebar-outline:hover i {
    color: #128C7E;
}
        /* =========================================================
       RELATED SERVICES
       ========================================================= */
        .related-services-header {
            text-align: center;
            margin-bottom: 28px;
        }

        .related-services-header .eyebrow {
            display: inline-block;
            font-size: 12px;
            font-weight: 700;
            letter-spacing: 1.2px;
            text-transform: uppercase;
            color: #28a745;
            margin-bottom: 8px;
        }

        .related-services-header h2 {
            font-size: 28px;
            font-weight: 800;
            color: #1a1a1a;
            margin: 0;
            letter-spacing: -0.4px;
        }

        /* =========================================================
       RESPONSIVE
       ========================================================= */
        @media (max-width: 991px) {
            .page-service-single {
                padding: 20px 0 40px;
            }

            .service-body {
                padding: 24px;
            }

            .service-name {
                font-size: 24px;
            }

            .service-sidebar-wrap {
                position: static;
                margin-top: 10px;
            }

            .service-cta {
                flex-direction: column;
                text-align: center;
            }

            .btn-enquire {
                width: 100%;
                justify-content: center;
            }
        }

        @media (max-width: 575px) {
            .page-service-single {
                padding: 15px 0 30px;
            }

            .service-back-row {
                margin-bottom: 14px;
            }

            .back-link {
                font-size: 13px;
                padding: 8px 14px;
            }

            .service-body {
                padding: 18px;
            }

            .service-name {
                font-size: 20px;
                margin-bottom: 12px;
            }

            .service-short-desc {
                font-size: 14px;
                margin-bottom: 16px;
                padding-bottom: 16px;
            }

            .service-entry {
                font-size: 14px;
                line-height: 1.75;
            }

            .service-entry h1 {
                font-size: 20px;
            }

            .service-entry h2 {
                font-size: 18px;
            }

            .service-entry h3 {
                font-size: 16px;
            }

            .service-cta {
                padding: 16px;
            }

            .btn-enquire {
                padding: 12px 18px;
                font-size: 13px;
                gap: 8px;
            }

            .btn-enquire i {
                font-size: 16px;
            }

            .service-share {
                flex-direction: column;
                align-items: flex-start;
                gap: 12px;
            }

            .sidebar-card {
                padding: 18px;
            }

            .related-services-header h2 {
                font-size: 22px;
            }
        }
    </style>
@endpush