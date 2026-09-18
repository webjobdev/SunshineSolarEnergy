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
@push('styles')
<style>
    .products-sidebar .sidebar-widget {
        background: #fff;
        padding: 20px;
        margin-bottom: 20px;
        border-radius: 8px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.05);
    }
    .products-sidebar .widget-title {
        font-size: 18px;
        font-weight: 600;
        margin-bottom: 15px;
        padding-bottom: 10px;
        border-bottom: 2px solid #f0f0f0;
    }
    .products-sidebar .filter-list {
        list-style: none;
        padding: 0;
        margin: 0;
    }
    .products-sidebar .filter-list li {
        margin-bottom: 10px;
    }
    .products-sidebar .filter-list label {
        display: flex;
        align-items: center;
        gap: 8px;
        cursor: pointer;
        font-size: 14px;
    }
    .products-sidebar .filter-list .count {
        margin-left: auto;
        color: #999;
        font-size: 12px;
    }
    .products-sidebar .search-box {
        display: flex;
        gap: 8px;
    }
    .products-sidebar .price-range-inputs {
        display: flex;
        align-items: center;
        gap: 8px;
    }
    .products-sidebar .price-range-inputs input {
        flex: 1;
    }
    .products-sidebar .btn-outline {
        border: 1px solid #ddd;
        padding: 10px;
        border-radius: 6px;
        color: #333;
        text-decoration: none;
    }
    .products-sidebar .btn-outline:hover {
        background: #f5f5f5;
    }
</style>
@endpush