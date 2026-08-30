@extends('frontend.layouts.app')

@section('title', $service->meta_title ?? ($service->title ?? 'Service Details - Solor Solar & Renewable Energy'))
@section('meta_description', $service->meta_description ?? 'Detailed information about our solar and renewable energy services')
@section('meta_keywords', $service->meta_keywords ?? 'solar service details, renewable energy service')

@section('content')
    <!-- Page Header -->
    @include('frontend.sections.page-header', [
        'title' => $service->title ?? 'Service Details',
        'breadcrumbs' => [
            ['label' => 'Home', 'url' => route('home')],
            ['label' => 'Services', 'url' => route('services')],
            ['label' => $service->title ?? 'Service Details', 'url' => null]
        ]
    ])
    
    <!-- Single Service Page -->
    @include('frontend.sections.service-single-content')
@endsection

@push('scripts')
<script>
    // Initialize WOW.js
    new WOW().init();
    
    // Initialize Magnific Popup for video
    $(document).ready(function() {
        $('.popup-video').magnificPopup({
            type: 'iframe',
            mainClass: 'mfp-fade',
            removalDelay: 160,
            preloader: false,
            fixedContentPos: false
        });
    });
</script>
@endpush