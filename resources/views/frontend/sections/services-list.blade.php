<!-- Services List Start -->
<div class="page-services">
    <div class="container">

        @if($services->count() > 0)

            <div class="services-header">
                <div class="row align-items-center">
                    <div class="col-lg-6">
                        <p class="services-count">
                            Showing <strong>{{ $services->count() }}</strong>
                            {{ Str::plural('service', $services->count()) }}
                        </p>
                    </div>
                </div>
            </div>

            <div class="row g-4">
                @foreach($services as $service)
                    <div class="col-lg-4 col-md-6">
                        <div class="service-item wow fadeInUp" data-wow-delay="{{ $loop->iteration * 0.08 }}s">
                            <a href="{{ route('service.single', $service->slug) }}" class="service-box-link" aria-label="{{ $service->name }}"></a>

                            <div class="service-image">
                                @if($service->thumbnail_url)
                                    <img src="{{ $service->thumbnail_url }}" alt="{{ $service->name }}" loading="lazy">
                                @else
                                    <img src="{{ asset('frontend/images/service-placeholder.jpg') }}" alt="{{ $service->name }}" loading="lazy">
                                @endif
                            </div>

                            <div class="service-content">
                                <h3>
                                    <a href="{{ route('service.single', $service->slug) }}">{{ $service->name }}</a>
                                </h3>

                                @if($service->excerpt)
                                    <p>{{ Str::limit($service->excerpt, 110) }}</p>
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

        @else
            <div class="services-empty">
                <div class="empty-icon">
                    <i class="fa-solid fa-screwdriver-wrench"></i>
                </div>
                <h3>No Services Available</h3>
                <p class="text-muted">Please check back later — new services are coming soon.</p>
                <a href="{{ route('home') }}" class="btn-default mt-3">
                    <i class="fa-solid fa-house"></i> Back to Home
                </a>
            </div>
        @endif

    </div>
</div>
<!-- Services List End -->

@push('styles')
<style>
/* =========================================================
   SERVICES PAGE
   ========================================================= */
.page-services {
    padding: 50px 0 70px;
    background: #fafbfc;
}

.services-header {
    margin-bottom: 24px;
}

.services-count {
    font-size: 14px;
    color: #666;
    margin: 0;
}

.services-count strong {
    color: #1a1a1a;
}

/* =========================================================
   SERVICE CARD
   ========================================================= */
.service-item {
    position: relative;
    background: #fff;
    border: 1px solid #f1f1f1;
    border-radius: 16px;
    overflow: hidden;
    height: 100%;
    display: flex;
    flex-direction: column;
    box-shadow: 0 2px 12px rgba(0, 0, 0, 0.04);
    transition: transform 0.3s ease, box-shadow 0.3s ease, border-color 0.3s ease;
}

.service-item:hover {
    transform: translateY(-6px);
    box-shadow: 0 14px 30px rgba(0, 0, 0, 0.09);
    border-color: #d6efde;
}

/* Overlay link covers entire card */
.service-box-link {
    position: absolute;
    inset: 0;
    z-index: 3;
    border-radius: 16px;
}

.service-image {
    position: relative;
    overflow: hidden;
    aspect-ratio: 4 / 3;
    background: #f8f9fa;
}

.service-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block;
    transition: transform 0.5s ease;
}

.service-item:hover .service-image img {
    transform: scale(1.06);
}

/* Soft overlay on image */
.service-image::after {
    content: '';
    position: absolute;
    inset: 0;
    background: linear-gradient(180deg, transparent 50%, rgba(0, 0, 0, 0.05) 100%);
    pointer-events: none;
}

.service-content {
    padding: 22px 22px 24px;
    display: flex;
    flex-direction: column;
    flex: 1;
}

.service-content h3 {
    font-size: 19px;
    font-weight: 700;
    line-height: 1.35;
    color: #1a1a1a;
    margin: 0 0 10px;
    letter-spacing: -0.2px;
}

.service-content h3 a {
    color: inherit;
    text-decoration: none;
    transition: color 0.2s;
}

.service-item:hover .service-content h3 a {
    color: #28a745;
}

.service-content p {
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

.service-read-more {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    font-size: 13px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    color: #28a745;
    margin-top: auto;
    transition: gap 0.2s ease;
}

.service-read-more i {
    font-size: 11px;
    transition: transform 0.2s ease;
}

.service-item:hover .service-read-more {
    gap: 10px;
}

.service-item:hover .service-read-more i {
    transform: translateX(3px);
}

/* =========================================================
   EMPTY STATE
   ========================================================= */
.services-empty {
    background: #fff;
    border: 1px solid #f1f1f1;
    border-radius: 16px;
    padding: 70px 24px;
    text-align: center;
}

.services-empty .empty-icon {
    width: 100px;
    height: 100px;
    margin: 0 auto 22px;
    border-radius: 50%;
    background: #f8f9fa;
    display: flex;
    align-items: center;
    justify-content: center;
}

.services-empty .empty-icon i {
    font-size: 42px;
    color: #c4c9ce;
}

.services-empty h3 {
    font-size: 22px;
    font-weight: 700;
    color: #1a1a1a;
    margin-bottom: 8px;
}

/* =========================================================
   RESPONSIVE
   ========================================================= */
@media (max-width: 991px) {
    .page-services {
        padding: 30px 0 50px;
    }
    .service-content {
        padding: 20px;
    }
    .service-content h3 {
        font-size: 18px;
    }
}

@media (max-width: 575px) {
    .page-services {
        padding: 20px 0 40px;
    }
    .service-content {
        padding: 18px;
    }
    .service-content h3 {
        font-size: 17px;
        margin-bottom: 8px;
    }
    .service-content p {
        font-size: 13px;
        margin-bottom: 12px;
    }
    .service-read-more {
        font-size: 12px;
    }
    .services-empty {
        padding: 50px 20px;
    }
    .services-empty h3 {
        font-size: 18px;
    }
}
</style>
@endpush