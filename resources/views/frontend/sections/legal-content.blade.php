@php
    $legalTitle   = $legalPage->title       ?? $title ?? 'Legal Information';
    $legalContent = $legalPage->description ?? '';
    $lastUpdated  = $legalPage->updated_at  ?? null;
@endphp

<article class="legal-content-area wow fadeInUp" data-wow-delay="0.25s">

    {{-- Header --}}
    <div class="legal-header">
        <h1>{{ $legalTitle }}</h1>

        @if($lastUpdated)
            <span class="last-updated">
                <i class="fa-regular fa-clock"></i>
                Last Updated:
                {{ $lastUpdated->format('F d, Y') }}
            </span>
        @endif
    </div>

    {{-- Content --}}
    @if(!empty($legalContent))
        <div class="legal-body">
            {!! $legalContent !!}
        </div>
    @else
        <div class="legal-empty">
            <div class="empty-icon">
                <i class="fa-regular fa-file-lines"></i>
            </div>
            <h3>Content Coming Soon</h3>
            <p>
                The <strong>{{ $legalTitle }}</strong> page is being prepared.
                Please check back later or contact us for more information.
            </p>

            <div class="empty-actions">
                <a href="{{ route('home') }}" class="btn-default">
                    <i class="fa-solid fa-house"></i>
                    Back to Home
                </a>
                <a href="{{ route('contact') }}" class="btn-outline">
                    <i class="fa-solid fa-envelope"></i>
                    Contact Us
                </a>
            </div>
        </div>
    @endif

    {{-- Footer help --}}
    @if(!empty($legalContent))
        <div class="legal-footer">
            <div class="legal-footer-icon">
                <i class="fa-solid fa-circle-question"></i>
            </div>
            <div class="legal-footer-text">
                <strong>Have questions about this policy?</strong>
                <span>Our team is here to help you.</span>
            </div>
            <a href="{{ route('contact') }}" class="btn-default">
                <i class="fa-solid fa-envelope"></i>
                Contact Us
            </a>
        </div>
    @endif

</article>