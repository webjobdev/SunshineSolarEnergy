@php
    // ✅ Real Google Maps embed URL (used inside <iframe>)
    $mapEmbedUrl = "https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3709.1556686501594!2d71.219673!3d21.618856899999997!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3958810032e4d4d3%3A0x30d58767dcad191a!2ssunshine%20solar%20amreli!5e0!3m2!1sen!2sin!4v1790543332300!5m2!1sen!2sin";

    // ✅ Short share URL (used for "Get Directions" button — opens in new tab)
    $mapShareUrl = "https://maps.app.goo.gl/C7HhSZLMkr3KzTLi7";

    $contactAddress = configSetting('contact_address');
    $webName        = configSetting('web_name', 'Us');
@endphp

<!-- Contact Map Start -->
<section class="contact-map-section">
    <div class="container">
        <div class="map-card wow fadeInUp">

            {{-- Map iframe --}}
            <div class="map-wrapper">
                <iframe
                    src="{{ $mapEmbedUrl }}"
                    width="100%"
                    height="100%"
                    style="border:0;"
                    allowfullscreen=""
                    loading="lazy"
                    referrerpolicy="strict-origin-when-cross-origin"
                    title="Visit {{ $webName }} — Location Map">
                </iframe>
            </div>

            {{-- Floating info card --}}
            <div class="map-overlay-info">
                <div class="map-pin-icon">
                    <i class="fa-solid fa-location-dot"></i>
                </div>

                <div class="map-info-text">
                    <strong>Visit Our Office</strong>
                    <span>
                        {{ $webName }}
                        @if($contactAddress)
                            — {{ $contactAddress }}
                        @endif
                    </span>
                </div>

                <a href="{{ $mapShareUrl }}"
                   target="_blank"
                   rel="noopener"
                   class="btn-map-direction">
                    <i class="fa-solid fa-diamond-turn-right"></i>
                    <span>Get Directions</span>
                </a>
            </div>

        </div>
    </div>
</section>
<!-- Contact Map End -->

@push('styles')
<style>
    .contact-map-section {
        padding: 40px 0 60px;
        background: #fafbfc;
    }

    .map-card {
        position: relative;
        border-radius: 20px;
        overflow: hidden;
        border: 1px solid #f1f1f1;
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.06);
        background: #fff;
    }

    .map-wrapper {
        width: 100%;
        height: 500px;
        background: #f0f0f0;
    }

    .map-wrapper iframe {
        display: block;
        width: 100%;
        height: 100%;
        filter: saturate(0.95);
    }

    /* Floating info bar over the bottom of the map */
    .map-overlay-info {
        position: absolute;
        left: 20px;
        right: 20px;
        bottom: 20px;
        display: flex;
        align-items: center;
        gap: 16px;
        background: rgba(255, 255, 255, 0.97);
        backdrop-filter: blur(12px);
        -webkit-backdrop-filter: blur(12px);
        padding: 16px 22px;
        border-radius: 16px;
        box-shadow: 0 12px 32px rgba(0, 0, 0, 0.12);
        flex-wrap: wrap;
    }

    .map-pin-icon {
        width: 52px;
        height: 52px;
        border-radius: 50%;
        background: #25D366;
        color: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 22px;
        flex-shrink: 0;
        box-shadow: 0 6px 18px rgba(37, 211, 102, 0.35);
    }

    .map-info-text {
        flex: 1;
        min-width: 200px;
    }

    .map-info-text strong {
        display: block;
        font-size: 15px;
        font-weight: 800;
        color: #1a1a1a;
        margin-bottom: 3px;
    }

    .map-info-text span {
        font-size: 13px;
        color: #666;
        line-height: 1.5;
    }

    .btn-map-direction {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: #28a745;
        color: #fff !important;
        padding: 12px 20px;
        border-radius: 10px;
        font-size: 14px;
        font-weight: 700;
        text-decoration: none;
        transition: all 0.25s ease;
        box-shadow: 0 4px 14px rgba(40, 167, 69, 0.3);
        white-space: nowrap;
    }

    .btn-map-direction:hover {
        background: #218838;
        color: #fff !important;
        transform: translateY(-2px);
        box-shadow: 0 8px 22px rgba(40, 167, 69, 0.45);
    }

    .btn-map-direction i {
        font-size: 13px;
    }

    /* Responsive */
    @media (max-width: 767px) {
        .contact-map-section {
            padding: 30px 0 40px;
        }

        .map-wrapper {
            height: 380px;
        }

        .map-overlay-info {
            left: 12px;
            right: 12px;
            bottom: 12px;
            padding: 14px 16px;
            gap: 12px;
        }

        .map-pin-icon {
            width: 44px;
            height: 44px;
            font-size: 18px;
        }

        .map-info-text strong {
            font-size: 14px;
        }

        .map-info-text span {
            font-size: 12px;
        }

        .btn-map-direction {
            padding: 10px 16px;
            font-size: 13px;
            width: 100%;
            justify-content: center;
        }
    }

    @media (max-width: 575px) {
        .map-wrapper {
            height: 320px;
        }
    }
</style>
@endpush