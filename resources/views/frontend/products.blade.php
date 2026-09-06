@extends('frontend.layouts.app')

@section('title', $productsPage->meta_title ?? 'Our Products - Solor Solar & Renewable Energy')
@section('meta_description', $productsPage->meta_description ?? 'Explore our range of solar and renewable energy products including solar panels, inverters, batteries, and more')
@section('meta_keywords', $productsPage->meta_keywords ?? 'solar products, solar panels, inverters, batteries, renewable energy')

@push('styles')
    {{-- @include('frontend.sections.products-css') --}}
@endpush

@section('content')
    <!-- Page Header -->
    @include('frontend.sections.page-header', [
        'title' => 'Our Products',
        'breadcrumbs' => [
            ['label' => 'Home', 'url' => route('home')],
            ['label' => 'Products', 'url' => null]
        ]
    ])
    
    <!-- Products Section -->
    @include('frontend.sections.products-list')
@endsection

@push('scripts')
<script>
    // Initialize WOW.js
    new WOW().init();
</script>
@endpush