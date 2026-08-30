<div class="legal-content-area wow fadeInUp" data-wow-delay="0.25s">
    @if($pageType == 'privacy')
        @include('frontend.legal.privacy-policy')
    @elseif($pageType == 'terms')
        @include('frontend.legal.terms-conditions')
    @elseif($pageType == 'disclaimer')
        @include('frontend.legal.disclaimer')
    @elseif($pageType == 'refund')
        @include('frontend.legal.refund-policy')
    @else
        <h1>Legal Information</h1>
        <p>Please select a legal page from the sidebar.</p>
    @endif
</div>