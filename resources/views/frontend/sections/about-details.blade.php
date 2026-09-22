@php
    $aboutTitle   = $about->title       ?? 'About Us';
    $aboutContent = $about->description ?? '';
    $lastUpdated  = $about->updated_at  ?? null;
@endphp

<!-- About Section Start -->
<div class="about-us">
    <div class="container">
        <div class="row align-items-center g-4">

            {{-- About images --}}
            <div class="col-lg-6">
                <div class="about-image">
                    <div class="about-img-1">
                        <figure class="reveal image-anime">
                            <img src="{{ asset('frontend/images/about-1.jpg') }}" alt="{{ $aboutTitle }}">
                        </figure>
                    </div>

                    <div class="about-img-2">
                        <figure class="reveal image-anime">
                            <img src="{{ asset('frontend/images/about-2.jpg') }}" alt="{{ $aboutTitle }}">
                        </figure>
                    </div>
                </div>
            </div>

            {{-- About content --}}
            <div class="col-lg-6">
                <div class="about-content-wrap">

                    <div class="section-title">
                        <h3 class="wow fadeInUp">About Us</h3>
                        <h2 class="text-anime">{{ $aboutTitle }}</h2>
                    </div>

                    @if($lastUpdated)
                        {{-- <span class="about-last-updated">
                            <i class="fa-regular fa-clock"></i>
                            Last updated: {{ $lastUpdated->format('F d, Y') }}
                        </span> --}}
                    @endif

                    @if(!empty($aboutContent))
                        <div class="about-content-body wow fadeInUp" data-wow-delay="0.25s">
                            {!! $aboutContent !!}
                        </div>
                    @else
                        <div class="about-empty">
                            <div class="empty-icon">
                                <i class="fa-regular fa-file-lines"></i>
                            </div>
                            <h3>Content Coming Soon</h3>
                            <p>
                                The <strong>About Us</strong> page is being prepared.
                                Please check back later.
                            </p>
                            <a href="{{ route('contact') }}" class="btn-default">
                                <i class="fa-solid fa-envelope"></i>
                                Contact Us
                            </a>
                        </div>
                    @endif

                </div>
            </div>

        </div>
    </div>
</div>
<!-- About Section End -->

@push('styles')
<style>
/* =========================================================
   ABOUT CONTENT (dynamic)
   ========================================================= */
.about-content-wrap {
    padding-left: 20px;
}

.about-last-updated {
    display: inline-flex;
    align-items: center;
    gap: 7px;
    font-size: 13px;
    color: #999;
    font-weight: 500;
    background: #f8f9fa;
    padding: 5px 12px;
    border-radius: 20px;
    margin: 8px 0 18px;
}

.about-last-updated i {
    color: #28a745;
    font-size: 12px;
}

/* Rich HTML body — same rules as legal body */
.about-content-body {
    font-size: 15px;
    line-height: 1.85;
    color: #444;
}

.about-content-body > *:first-child { margin-top: 0; }
.about-content-body > *:last-child  { margin-bottom: 0; }

.about-content-body p {
    margin: 0 0 16px;
}

.about-content-body h1,
.about-content-body h2,
.about-content-body h3,
.about-content-body h4 {
    color: #1a1a1a;
    font-weight: 700;
    line-height: 1.35;
    margin: 26px 0 12px;
}

.about-content-body h1 { font-size: 26px; }
.about-content-body h2 { font-size: 22px; }
.about-content-body h3 { font-size: 19px; }
.about-content-body h4 { font-size: 17px; }

.about-content-body strong {
    color: #1a1a1a;
    font-weight: 700;
}

.about-content-body a {
    color: #28a745;
    text-decoration: underline;
    transition: color 0.2s;
}

.about-content-body a:hover {
    color: #128C7E;
}

.about-content-body img {
    max-width: 100%;
    height: auto;
    border-radius: 10px;
    margin: 16px 0;
}

.about-content-body ul,
.about-content-body ol {
    padding-left: 22px;
    margin: 0 0 18px;
}

.about-content-body li {
    margin-bottom: 8px;
    line-height: 1.75;
}

.about-content-body ul li::marker {
    color: #28a745;
    font-weight: 700;
}

.about-content-body blockquote {
    border-left: 4px solid #28a745;
    background: #f7fbf9;
    padding: 16px 22px;
    margin: 20px 0;
    border-radius: 8px;
    color: #555;
    font-style: italic;
    font-size: 15px;
}

.about-content-body table {
    width: 100%;
    border-collapse: collapse;
    margin: 20px 0;
    font-size: 14px;
    border-radius: 8px;
    overflow: hidden;
}

.about-content-body table td,
.about-content-body table th {
    border: 1px solid #e5e5e5;
    padding: 12px 16px;
    text-align: left;
}

.about-content-body table th {
    background: #f8f9fa;
    font-weight: 700;
    color: #1a1a1a;
}

.about-content-body hr {
    border: none;
    border-top: 1px solid #f0f0f0;
    margin: 26px 0;
}

/* =========================================================
   EMPTY STATE
   ========================================================= */
.about-empty {
    text-align: center;
    background: #fff;
    border: 1px solid #f1f1f1;
    border-radius: 16px;
    padding: 40px 24px;
    margin-top: 20px;
}

.about-empty .empty-icon {
    width: 80px;
    height: 80px;
    margin: 0 auto 18px;
    border-radius: 50%;
    background: #f8f9fa;
    display: flex;
    align-items: center;
    justify-content: center;
}

.about-empty .empty-icon i {
    font-size: 34px;
    color: #c4c9ce;
}

.about-empty h3 {
    font-size: 20px;
    font-weight: 700;
    color: #1a1a1a;
    margin: 0 0 10px;
}

.about-empty p {
    font-size: 14px;
    color: #666;
    max-width: 400px;
    margin: 0 auto 20px;
    line-height: 1.7;
}

.about-empty .btn-default {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    background: #28a745;
    color: #fff !important;
    padding: 12px 22px;
    border-radius: 10px;
    font-weight: 600;
    font-size: 14px;
    text-decoration: none;
    transition: all 0.2s;
    box-shadow: 0 4px 12px rgba(40, 167, 69, 0.25);
}

.about-empty .btn-default:hover {
    background: #218838;
    transform: translateY(-2px);
    box-shadow: 0 6px 16px rgba(40, 167, 69, 0.35);
}

/* =========================================================
   RESPONSIVE
   ========================================================= */
@media (max-width: 991px) {
    .about-content-wrap {
        padding-left: 0;
        margin-top: 30px;
    }

    .about-content-body {
        font-size: 14px;
    }

    .about-content-body h1 { font-size: 22px; }
    .about-content-body h2 { font-size: 19px; }
    .about-content-body h3 { font-size: 17px; }
}

@media (max-width: 575px) {
    .about-content-wrap {
        margin-top: 20px;
    }

    .about-content-body {
        font-size: 14px;
        line-height: 1.75;
    }

    .about-content-body h1 { font-size: 20px; }
    .about-content-body h2 { font-size: 18px; }
    .about-content-body h3 { font-size: 16px; }

    .about-content-body table {
        font-size: 13px;
    }

    .about-content-body table td,
    .about-content-body table th {
        padding: 8px 10px;
    }

    .about-empty {
        padding: 30px 16px;
    }

    .about-empty h3 { font-size: 17px; }
    .about-empty p  { font-size: 13px; }
}
</style>
@endpush