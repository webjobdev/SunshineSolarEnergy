@php
    $whatsappNumber = configSetting('whatsapp_number');
    $contactPhone = configSetting('contact_phone');
    $contactEmail = configSetting('contact_email');
    $webName = configSetting('web_name', 'Us');
@endphp

<!-- Contact WhatsApp CTA Start -->
<section class="contact-whatsapp-section">
    <div class="container">

        <div class="whatsapp-cta-card wow fadeInUp">

            {{-- Left: Big WhatsApp icon + text --}}
            <div class="whatsapp-cta-left">
                <div class="whatsapp-icon-wrap">
                    <i class="fa-brands fa-whatsapp"></i>
                    <span class="ping"></span>
                </div>

                <div class="whatsapp-cta-text">
                    <h2>
                        Let's Talk on <span>WhatsApp</span>
                    </h2>
                    <p>
                        No forms, no waiting. Chat with our team directly on WhatsApp —
                        we usually reply within minutes.
                    </p>
                </div>
            </div>

            {{-- Right: Big CTA buttons --}}
            <div class="whatsapp-cta-actions">

                @if($whatsappNumber)
                    <a href="{{ whatsappUrl('Hello ' . $webName . ', I would like to know more about your services.') }}"
                        target="_blank" rel="noopener" class="btn-whatsapp-main">
                        <i class="fa-brands fa-whatsapp"></i>
                        <span>Chat on WhatsApp</span>
                        <i class="fa-solid fa-arrow-right btn-arrow"></i>
                    </a>
                @endif

                <div class="quick-actions-row">

                    @if($contactPhone)
                        <a href="tel:{{ $contactPhone }}" class="quick-action">
                            <i class="fa-solid fa-phone"></i>
                            <span>{{ $contactPhone }}</span>
                        </a>
                    @endif

                    @if($contactEmail)
                        <a href="mailto:{{ $contactEmail }}" class="quick-action">
                            <i class="fa-solid fa-envelope"></i>
                            <span>{{ $contactEmail }}</span>
                        </a>
                    @endif

                </div>

            </div>

        </div>

        {{-- Trust badges --}}
        <div class="contact-trust-row wow fadeInUp" data-wow-delay="0.25s">

            <div class="trust-item">
                <i class="fa-solid fa-clock"></i>
                <div>
                    <strong>Quick Reply</strong>
                    <span>Within minutes</span>
                </div>
            </div>

            <div class="trust-item">
                <i class="fa-solid fa-user-shield"></i>
                <div>
                    <strong>Verified Team</strong>
                    <span>Real humans, real answers</span>
                </div>
            </div>

            <div class="trust-item">
                <i class="fa-solid fa-headset"></i>
                <div>
                    <strong>Free Consultation</strong>
                    <span>No obligation</span>
                </div>
            </div>

        </div>

    </div>
</section>
<!-- Contact WhatsApp CTA End -->

@push('styles')
    <style>
        .contact-whatsapp-section {
            padding: 40px 0 80px;
            background: linear-gradient(180deg, #fafbfc 0%, #f0fdf4 100%);
        }

        /* Big CTA card */
        .whatsapp-cta-card {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 40px;
            background: linear-gradient(135deg, #0f172a 0%, #134e4a 100%);
            border-radius: 24px;
            padding: 48px 44px;
            color: #fff;
            position: relative;
            overflow: hidden;
            flex-wrap: wrap;
            box-shadow: 0 24px 60px rgba(15, 23, 42, 0.25);
        }

        .whatsapp-cta-card::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -20%;
            width: 500px;
            height: 500px;
            background: radial-gradient(circle, rgba(37, 211, 102, 0.15) 0%, transparent 70%);
            pointer-events: none;
        }

        /* Left side */
        .whatsapp-cta-left {
            display: flex;
            align-items: center;
            gap: 24px;
            flex: 1;
            min-width: 300px;
            position: relative;
            z-index: 1;
        }

        .whatsapp-icon-wrap {
            position: relative;
            width: 88px;
            height: 88px;
            border-radius: 50%;
            background: #25D366;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 42px;
            color: #fff;
            flex-shrink: 0;
            box-shadow: 0 12px 32px rgba(37, 211, 102, 0.5);
        }

        .whatsapp-icon-wrap .ping {
            position: absolute;
            inset: -10px;
            border-radius: 50%;
            border: 2px solid rgba(37, 211, 102, 0.5);
            animation: ping-ring 2s ease-out infinite;
        }

        @keyframes ping-ring {
            0% {
                transform: scale(0.9);
                opacity: 1;
            }

            100% {
                transform: scale(1.35);
                opacity: 0;
            }
        }

        .whatsapp-cta-text h2 {
            font-size: 30px;
            font-weight: 800;
            line-height: 1.2;
            margin: 0 0 10px;
            color: #fff;
            letter-spacing: -0.5px;
        }

        .whatsapp-cta-text h2 span {
            color: #25D366;
        }

        .whatsapp-cta-text p {
            font-size: 15px;
            line-height: 1.65;
            color: rgba(255, 255, 255, 0.75);
            margin: 0;
            max-width: 460px;
        }

        /* Right side */
        .whatsapp-cta-actions {
            display: flex;
            flex-direction: column;
            gap: 16px;
            min-width: 300px;
            position: relative;
            z-index: 1;
        }

        .btn-whatsapp-main {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
            background: #25D366;
            color: #fff !important;
            padding: 18px 28px;
            border-radius: 14px;
            font-size: 17px;
            font-weight: 800;
            text-decoration: none;
            transition: all 0.25s ease;
            box-shadow: 0 10px 28px rgba(37, 211, 102, 0.45);
            border: none;
            letter-spacing: 0.2px;
        }

        .btn-whatsapp-main:hover {
            background: #128C7E;
            color: #fff !important;
            transform: translateY(-3px);
            box-shadow: 0 16px 36px rgba(37, 211, 102, 0.55);
        }

        .btn-whatsapp-main i:first-child {
            font-size: 22px;
        }

        .btn-whatsapp-main .btn-arrow {
            font-size: 13px;
            transition: transform 0.25s ease;
        }

        .btn-whatsapp-main:hover .btn-arrow {
            transform: translateX(5px);
        }

        /* Quick actions row */
        .quick-actions-row {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }

        .quick-action {
            flex: 1;
            min-width: 130px;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            background: rgba(255, 255, 255, 0.08);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.12);
            color: #fff !important;
            padding: 13px 16px;
            border-radius: 12px;
            font-size: 14px;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.25s ease;
        }

        .quick-action i {
            font-size: 15px;
            color: #25D366;
            flex-shrink: 0;
        }

        .quick-action span {
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .quick-action:hover {
            background: rgba(37, 211, 102, 0.15);
            border-color: rgba(37, 211, 102, 0.4);
            transform: translateY(-2px);
        }

        /* Trust row */
        .contact-trust-row {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 18px;
            margin-top: 40px;
        }

        .trust-item {
            display: flex;
            align-items: center;
            gap: 14px;
            background: #fff;
            border: 1px solid #f1f1f1;
            border-radius: 14px;
            padding: 20px 22px;
            box-shadow: 0 2px 12px rgba(0, 0, 0, 0.04);
            transition: transform 0.25s ease, box-shadow 0.25s ease;
        }

        .trust-item:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 28px rgba(0, 0, 0, 0.07);
        }

        .trust-item>i {
            width: 44px;
            height: 44px;
            border-radius: 50%;
            background: #e6f4ea;
            color: #28a745;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
            flex-shrink: 0;
        }

        .trust-item strong {
            display: block;
            font-size: 14px;
            font-weight: 700;
            color: #1a1a1a;
            margin-bottom: 2px;
        }

        .trust-item span {
            font-size: 12px;
            color: #999;
            font-weight: 500;
        }

        /* Responsive */
        @media (max-width: 991px) {
            .contact-whatsapp-section {
                padding: 30px 0 60px;
            }

            .whatsapp-cta-card {
                padding: 36px 28px;
                gap: 30px;
            }

            .whatsapp-cta-text h2 {
                font-size: 24px;
            }

            .whatsapp-icon-wrap {
                width: 72px;
                height: 72px;
                font-size: 34px;
            }
        }

        @media (max-width: 767px) {
            .whatsapp-cta-card {
                padding: 30px 22px;
                text-align: center;
            }

            .whatsapp-cta-left {
                flex-direction: column;
                text-align: center;
                gap: 16px;
            }

            .whatsapp-cta-text p {
                max-width: 100%;
            }

            .whatsapp-cta-actions {
                min-width: 100%;
                width: 100%;
            }

            .btn-whatsapp-main {
                font-size: 15px;
                padding: 16px 22px;
            }

            .quick-actions-row {
                flex-direction: column;
            }

            .quick-action {
                justify-content: center;
            }
        }

        @media (max-width: 575px) {
            .whatsapp-cta-text h2 {
                font-size: 20px;
            }

            .whatsapp-icon-wrap {
                width: 64px;
                height: 64px;
                font-size: 30px;
            }

            .contact-trust-row {
                margin-top: 26px;
            }

            .trust-item {
                padding: 16px 18px;
            }
        }
    </style>
@endpush