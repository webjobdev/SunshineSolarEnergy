@extends('frontend.layouts.app')

@section('title', $faqPage->meta_title ?? 'FAQs - Solor Solar & Renewable Energy')
@section('meta_description', $faqPage->meta_description ?? 'Frequently asked questions about solar energy, renewable energy solutions, installation process, and our services')
@section('meta_keywords', $faqPage->meta_keywords ?? 'faq, solar energy faq, renewable energy questions, solar installation')

@push('styles')
@include('frontend.sections.faq-styles')    
@endpush

@section('content')
    <!-- Page Header -->
    @include('frontend.sections.page-header', [
        'title' => 'FAQs',
        'breadcrumbs' => [
            ['label' => 'Home', 'url' => route('home')],
            ['label' => 'FAQs', 'url' => null]
        ]
    ])
    <!-- Still Have Questions Section -->
    @include('frontend.sections.faq-cta')
    
    <!-- FAQs Content -->
    @include('frontend.sections.faq-content')
    
 
@endsection

@push('scripts')
@include('frontend.sections.faq-filter-js')
<script>
    // Initialize WOW.js
    new WOW().init();
    
    // Smooth scroll to FAQ item on hash change
    $(document).ready(function() {
        if (window.location.hash) {
            var target = $(window.location.hash);
            if (target.length) {
                setTimeout(function() {
                    $('html, body').animate({
                        scrollTop: target.offset().top - 100
                    }, 500);
                    target.find('.accordion-button').addClass('show');
                    target.find('.accordion-collapse').addClass('show');
                }, 300);
            }
        }
    });
</script>
@endpush