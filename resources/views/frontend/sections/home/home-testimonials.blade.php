<!-- Home Testimonials Section Start -->
<section class="home-testimonials-section">
    <div class="container">

        <div class="testimonials-header">
            <h3 class="wow fadeInUp">Testimonials</h3>
            <h2 class="text-anime">What Our Customers Say</h2>
            <p class="testimonials-sub wow fadeInUp" data-wow-delay="0.2s">
                Real feedback from customers who trust us for their solar energy needs.
            </p>
        </div>

        <div class="testimonials-grid">
            @foreach($testimonials as $review)
                <div class="testimonial-card wow fadeInUp" data-wow-delay="{{ $loop->iteration * 0.08 }}s">

                    {{-- BIG IMAGE (500px height) --}}
                    <div class="testimonial-image">
                        @if($review->image_url)
                            <img src="{{ $review->image_url }}"
                                 alt="{{ $review->name }} — Solar Customer"
                                 loading="lazy"
                                 class="full-image">
                        @else
                            <div class="testimonial-image-placeholder">
                                <i class="fa-solid fa-solar-panel"></i>
                                <span>Solar Installation</span>
                            </div>
                        @endif

                        {{-- Location badge --}}
                        <span class="testimonial-location-badge">
                            <i class="fa-solid fa-location-dot"></i>
                            {{ $review->name }}
                        </span>

                        {{-- Solar badge --}}
                        <span class="testimonial-solar-badge">
                            <i class="fa-solid fa-solar-panel"></i>
                        </span>

                        {{-- Stars overlay --}}
                        <div class="testimonial-stars-overlay">
                            @for($i = 1; $i <= 5; $i++)
                                <i class="fa-solid fa-star"></i>
                            @endfor
                        </div>
                    </div>

                    {{-- INFO BODY --}}
                    <div class="testimonial-body">
                        <h4 class="testimonial-customer-name">
                            {{ $review->name }}
                        </h4>

                        <p class="testimonial-text">
                            {{ $review->description ?: 'Great service and reliable support — highly recommended for anyone going solar.' }}
                        </p>

                        <div class="testimonial-footer">
                            <span class="verified-tag">
                                <i class="fa-solid fa-circle-check"></i>
                                Verified Solar Customer
                            </span>

                            <span class="testimonial-badge-type">
                                <i class="fa-solid fa-bolt"></i>
                                Solar
                            </span>
                        </div>
                    </div>

                </div>
            @endforeach
        </div>

    </div>
</section>
<!-- Home Testimonials Section End -->

@push('styles')
<style>
/* =========================================================
   TESTIMONIALS SECTION
   ========================================================= */
.home-testimonials-section {
    padding: 70px 0;
    background: linear-gradient(180deg, #fafbfc 0%, #f0fdf4 100%);
}

.testimonials-header {
    text-align: center;
    margin-bottom: 44px;
    max-width: 640px;
    margin-left: auto;
    margin-right: auto;
}

.testimonials-header h3 {
    color: #28a745;
    font-size: 14px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 1.2px;
    margin: 0 0 10px;
}

.testimonials-header h2 {
    font-size: 32px;
    font-weight: 700;
    color: #1a1a1a;
    margin: 0 0 12px;
    letter-spacing: -0.5px;
    line-height: 1.25;
}

.testimonials-sub {
    font-size: 15px;
    color: #666;
    line-height: 1.7;
    margin: 0;
}

/* =========================================================
   GRID — smaller min-width so cards stay compact
   ========================================================= */
.testimonials-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
    gap: 24px;
}

/* =========================================================
   CARD
   ========================================================= */
.testimonial-card {
    position: relative;
    background: #fff;
    border: 1px solid #f1f1f1;
    border-radius: 16px;
    overflow: hidden;
    display: flex;
    flex-direction: column;
    transition: transform 0.35s ease, box-shadow 0.35s ease, border-color 0.35s ease;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.04);
}

.testimonial-card:hover {
    transform: translateY(-6px);
    box-shadow: 0 16px 36px rgba(0, 0, 0, 0.10);
    border-color: #d6efde;
}

/* =========================================================
   BIG IMAGE — FIXED 500px HEIGHT
   ========================================================= */
.testimonial-image {
    position: relative;
    width: 100%;
    height:300px;                 /* ← fixed 500px height */
    background: #f8f9fa;
    overflow: hidden;
    flex-shrink: 0;
}

.testimonial-image .full-image {
    width: 100%;
    height: 100%;
    object-fit: cover;
    object-position: center;
    display: block;
    transition: transform 0.6s ease;
}

.testimonial-card:hover .testimonial-image .full-image {
    transform: scale(1.06);
}

/* Gradient overlay */
.testimonial-image::after {
    content: '';
    position: absolute;
    inset: 0;
    background: linear-gradient(180deg,
        rgba(0, 0, 0, 0.15) 0%,
        transparent 35%,
        transparent 65%,
        rgba(0, 0, 0, 0.55) 100%);
    pointer-events: none;
    z-index: 1;
}

/* Placeholder */
.testimonial-image-placeholder {
    width: 100%;
    height: 100%;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    gap: 12px;
    background: linear-gradient(135deg, #f0fdf4 0%, #e6f4ea 100%);
    color: #28a745;
}

.testimonial-image-placeholder i {
    font-size: 56px;
    opacity: 0.55;
}

.testimonial-image-placeholder span {
    font-size: 13px;
    font-weight: 600;
    letter-spacing: 0.5px;
    text-transform: uppercase;
    opacity: 0.7;
}

/* =========================================================
   BADGES OVER IMAGE
   ========================================================= */
.testimonial-location-badge {
    position: absolute;
    top: 12px;
    left: 12px;
    z-index: 2;
    display: inline-flex;
    align-items: center;
    gap: 6px;
    background: rgba(0, 0, 0, 0.55);
    backdrop-filter: blur(8px);
    -webkit-backdrop-filter: blur(8px);
    color: #fff;
    font-size: 11px;
    font-weight: 700;
    padding: 6px 12px;
    border-radius: 20px;
    letter-spacing: 0.3px;
    max-width: calc(100% - 100px);
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

.testimonial-location-badge i {
    font-size: 10px;
    color: #f5b81a;
    flex-shrink: 0;
}

.testimonial-solar-badge {
    position: absolute;
    top: 12px;
    right: 12px;
    z-index: 2;
    width: 34px;
    height: 34px;
    border-radius: 50%;
    background: #28a745;
    color: #fff;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 14px;
    border: 2px solid rgba(255, 255, 255, 0.9);
    box-shadow: 0 4px 12px rgba(40, 167, 69, 0.4);
    transition: transform 0.3s ease;
}

.testimonial-card:hover .testimonial-solar-badge {
    transform: rotate(-10deg) scale(1.1);
}

.testimonial-stars-overlay {
    position: absolute;
    bottom: 12px;
    left: 12px;
    z-index: 2;
    display: flex;
    gap: 3px;
    background: rgba(0, 0, 0, 0.55);
    backdrop-filter: blur(8px);
    -webkit-backdrop-filter: blur(8px);
    padding: 6px 10px;
    border-radius: 20px;
}

.testimonial-stars-overlay i {
    font-size: 11px;
    color: #f5b81a;
}

/* =========================================================
   INFO BODY
   ========================================================= */
.testimonial-body {
    padding: 20px 22px 22px;
    display: flex;
    flex-direction: column;
    flex: 1;
}

.testimonial-customer-name {
    font-size: 17px;
    font-weight: 800;
    color: #1a1a1a;
    margin: 0 0 8px;
    line-height: 1.3;
    letter-spacing: -0.2px;
}

.testimonial-text {
    font-size: 14px;
    line-height: 1.7;
    color: #555;
    margin: 0 0 16px;
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
    overflow: hidden;
    flex: 1;
}

.testimonial-footer {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 10px;
    padding-top: 14px;
    border-top: 1px solid #f5f5f5;
    margin-top: auto;
    flex-wrap: wrap;
}

.verified-tag {
    display: inline-flex;
    align-items: center;
    gap: 5px;
    font-size: 12px;
    color: #28a745;
    font-weight: 700;
    background: #e6f4ea;
    padding: 4px 10px;
    border-radius: 20px;
    line-height: 1.4;
    white-space: nowrap;
}

.verified-tag i {
    font-size: 11px;
}

.testimonial-badge-type {
    display: inline-flex;
    align-items: center;
    gap: 5px;
    font-size: 11px;
    color: #555;
    font-weight: 700;
    background: #f8f9fa;
    padding: 4px 10px;
    border-radius: 20px;
    text-transform: uppercase;
    letter-spacing: 0.4px;
}

.testimonial-badge-type i {
    color: #f5b81a;
    font-size: 11px;
}

/* =========================================================
   RESPONSIVE
   ========================================================= */
@media (max-width: 991px) {
    .home-testimonials-section {
        padding: 50px 0;
    }

    .testimonials-header h2 {
        font-size: 26px;
    }

    .testimonial-image {
        height: 420px;             /* smaller on tablet */
    }
}

@media (max-width: 575px) {
    .home-testimonials-section {
        padding: 40px 0;
    }

    .testimonials-header h2 {
        font-size: 22px;
    }

    .testimonials-header {
        margin-bottom: 30px;
    }

    .testimonials-grid {
        gap: 16px;
    }

    .testimonial-image {
        height: 340px;             /* smaller on mobile */
    }

    .testimonial-body {
        padding: 16px 18px 18px;
    }

    .testimonial-customer-name {
        font-size: 15px;
    }

    .testimonial-text {
        font-size: 13px;
        -webkit-line-clamp: 2;
    }

    .testimonial-solar-badge {
        width: 30px;
        height: 30px;
        font-size: 12px;
        top: 10px;
        right: 10px;
    }

    .testimonial-location-badge {
        font-size: 10px;
        padding: 5px 10px;
        top: 10px;
        left: 10px;
    }

    .verified-tag {
        font-size: 11px;
        padding: 3px 8px;
    }

    .testimonial-badge-type {
        font-size: 10px;
        padding: 3px 8px;
    }
}
</style>
@endpush