@php
    $contactEmail = configSetting('contact_email');
    $contactPhone = configSetting('contact_phone');
    $contactAddress = configSetting('contact_address');
    $whatsappNumber = configSetting('whatsapp_number');

    $socials = [
        'facebook' => configSetting('social_facebook'),
        'twitter' => configSetting('social_twitter'),
        'instagram' => configSetting('social_instagram'),
        'linkedin' => configSetting('social_linkedin'),
        'youtube' => configSetting('social_youtube'),
    ];
    $hasSocials = collect($socials)->filter()->isNotEmpty();
@endphp

<!-- Contact Information Section Start -->
<section class="contact-info-section">
    <div class="container">

        <div class="section-title text-center">
            <h3 class="wow fadeInUp">Contact Details</h3>
            <h2 class="text-anime">We'd Love to Hear From You</h2>
            <p class="contact-sub wow fadeInUp" data-wow-delay="0.2s">
                Reach us directly — quick replies on WhatsApp, or use phone & email below.
            </p>
        </div>

        <div class="row g-4">

            {{-- Address --}}
            @if($contactAddress)
                <div class="col-lg-3 col-md-6">
                    <div class="contact-card wow fadeInUp" data-wow-delay="0.25s">
                        <div class="contact-card-icon">
                            <i class="fa-solid fa-location-dot"></i>
                        </div>
                        <h4>Visit Us</h4>
                        <p>{{ $contactAddress }}</p>
                    </div>
                </div>
            @endif

            {{-- Email --}}
            @if($contactEmail)
                <div class="col-lg-3 col-md-6">
                    <div class="contact-card wow fadeInUp" data-wow-delay="0.5s">
                        <div class="contact-card-icon">
                            <i class="fa-solid fa-envelope"></i>
                        </div>
                        <h4>Email Us</h4>
                        <p>
                            <a href="mailto:{{ $contactEmail }}">{{ $contactEmail }}</a>
                        </p>
                    </div>
                </div>
            @endif

            {{-- Phone --}}
            @if($contactPhone)
                <div class="col-lg-3 col-md-6">
                    <div class="contact-card wow fadeInUp" data-wow-delay="0.75s">
                        <div class="contact-card-icon">
                            <i class="fa-solid fa-phone"></i>
                        </div>
                        <h4>Call Us</h4>
                        <p>
                            <a href="tel:{{ $contactPhone }}">{{ $contactPhone }}</a>
                        </p>
                    </div>
                </div>
            @endif

            {{-- Social / WhatsApp --}}
            @if($hasSocials || $whatsappNumber)
                <div class="col-lg-3 col-md-6">
                    <div class="contact-card wow fadeInUp" data-ssw-delay="1s">
                        <div class="contact-card-icon">
                            <i class="fa-solid fa-share-nodes"></i>
                        </div>
                        <h4>Follow Us</h4>

                        <div class="contact-socials">
                            @if($socials['facebook'])
                                <a href="{{ $socials['facebook'] }}" target="_blank" rel="noopener" aria-label="Facebook"><i
                                        class="fa-brands fa-facebook-f"></i></a>
                            @endif
                            @if($socials['twitter'])
                                <a href="{{ $socials['twitter'] }}" target="_blank" rel="noopener" aria-label="Twitter"><i
                                        class="fa-brands fa-twitter"></i></a>
                            @endif
                            @if($socials['instagram'])
                                <a href="{{ $socials['instagram'] }}" target="_blank" rel="noopener" aria-label="Instagram"><i
                                        class="fa-brands fa-instagram"></i></a>
                            @endif
                            @if($socials['linkedin'])
                                <a href="{{ $socials['linkedin'] }}" target="_blank" rel="noopener" aria-label="LinkedIn"><i
                                        class="fa-brands fa-linkedin-in"></i></a>
                            @endif
                            @if($socials['youtube'])
                                <a href="{{ $socials['youtube'] }}" target="_blank" rel="noopener" aria-label="YouTube"><i
                                        class="fa-brands fa-youtube"></i></a>
                            @endif
                            @if($whatsappNumber)
                                <a href="{{ whatsappUrl('Hello, I would like to know more about your services.') }}"
                                    target="_blank" rel="noopener" aria-label="WhatsApp" class="social-whatsapp">
                                    <i class="fa-brands fa-whatsapp"></i>
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            @endif

        </div>
    </div>
</section>
<!-- Contact Information Section End -->

@push('styles')
    <style>
        .contact-info-section {
            padding: 70px 0 40px;
            background: #fafbfc;
        }

        .contact-info-section .section-title {
            max-width: 640px;
            margin: 0 auto 44px;
        }

        .contact-info-section .section-title h3 {
            color: #28a745;
            font-size: 14px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1.2px;
            margin: 0 0 10px;
        }

        .contact-info-section .section-title h2 {
            font-size: 32px;
            font-weight: 700;
            color: #1a1a1a;
            margin: 0 0 12px;
            letter-spacing: -0.5px;
            line-height: 1.25;
        }

        .contact-sub {
            font-size: 15px;
            color: #666;
            line-height: 1.7;
            margin: 0;
        }

        /* Card */
        .contact-card {
            background: #fff;
            border: 1px solid #f1f1f1;
            border-radius: 16px;
            padding: 28px 22px 24px;
            height: 100%;
            text-align: center;
            transition: transform 0.3s ease, box-shadow 0.3s ease, border-color 0.3s ease;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.04);
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .contact-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 16px 36px rgba(0, 0, 0, 0.08);
            border-color: #d6efde;
        }

        .contact-card-icon {
            width: 58px;
            height: 58px;
            border-radius: 50%;
            background: linear-gradient(135deg, #e6f4ea 0%, #d0ecdb 100%);
            color: #28a745;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 22px;
            margin-bottom: 14px;
            transition: transform 0.3s ease;
        }

        .contact-card:hover .contact-card-icon {
            transform: scale(1.08) rotate(-5deg);
        }

        .contact-card h4 {
            font-size: 15px;
            font-weight: 700;
            color: #1a1a1a;
            text-transform: uppercase;
            letter-spacing: 0.8px;
            margin: 0 0 10px;
        }

        .contact-card p {
            font-size: 14px;
            color: #666;
            line-height: 1.65;
            margin: 0;
            word-break: break-word;
        }

        .contact-card a {
            color: #28a745;
            text-decoration: none;
            font-weight: 600;
            transition: color 0.2s;
        }

        .contact-card a:hover {
            color: #128C7E;
            text-decoration: underline;
        }

        /* Socials */
        .contact-socials {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
            justify-content: center;
            margin-top: 4px;
        }

        .contact-socials a {
            width: 38px;
            height: 38px;
            border-radius: 50%;
            background: #f5f5f5;
            color: #555;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 14px;
            transition: all 0.2s;
        }

        .contact-socials a:hover {
            background: #28a745;
            color: #fff;
            transform: translateY(-3px);
            box-shadow: 0 6px 14px rgba(40, 167, 69, 0.3);
        }

        .contact-socials a.social-whatsapp {
            background: #25D366;
            color: #fff;
            box-shadow: 0 4px 12px rgba(37, 211, 102, 0.35);
        }

        .contact-socials a.social-whatsapp:hover {
            background: #128C7E;
        }

        /* Responsive */
        @media (max-width: 767px) {
            .contact-info-section {
                padding: 50px 0 30px;
            }

            .contact-info-section .section-title h2 {
                font-size: 24px;
            }

            .contact-card {
                padding: 22px 18px 20px;
            }

            .contact-card-icon {
                width: 52px;
                height: 52px;
                font-size: 20px;
            }
        }
    </style>
@endpush