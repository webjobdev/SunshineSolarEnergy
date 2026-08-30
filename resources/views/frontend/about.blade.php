@extends('frontend.layouts.app')

@section('title', $aboutPage->meta_title ?? 'About Us - Solor Solar & Renewable Energy')
@section('meta_description', $aboutPage->meta_description ?? 'Learn about Solor - your trusted partner in solar and renewable energy solutions')
@section('meta_keywords', $aboutPage->meta_keywords ?? 'about us, solar energy, renewable energy, green energy')

@section('content')
    <!-- Page Header -->
    @include('frontend.sections.page-header', [
        'title' => 'About us',
        'breadcrumbs' => [
            ['label' => 'Home', 'url' => route('home')],
            ['label' => 'About us', 'url' => null]
        ]
    ])
    
    <!-- About Section -->
    @include('frontend.sections.about-details')
    
    <!-- Why Choose Us -->
    @include('frontend.sections.why-choose')
    
    <!-- Our Process -->
    @include('frontend.sections.process')
    
    <!-- Infobar/CTA -->
    @include('frontend.sections.infobar')
    
    <!-- Latest Projects -->
    @include('frontend.sections.latest-projects')
    
    <!-- Counter Section -->
    @include('frontend.sections.counter')
    
    <!-- Testimonials -->
    @include('frontend.sections.testimonials')
    
    <!-- Our Team -->
    @include('frontend.sections.team')
@endsection

@push('scripts')
<script>
    // Initialize WOW.js
    new WOW().init();
    
    // Initialize Counter
    $(document).ready(function() {
        $('.counter').counterUp({
            delay: 10,
            time: 1000
        });
    });
</script>
@endpush