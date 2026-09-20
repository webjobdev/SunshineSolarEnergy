@extends('frontend.layouts.app')

@section('title', $productsPage->meta_title ?? 'Our Products - Solor Solar & Renewable Energy')
@section('meta_description', $productsPage->meta_description ?? 'Explore our range of solar and renewable energy products including solar panels, inverters, batteries, and more')
@section('meta_keywords', $productsPage->meta_keywords ?? 'solar products, solar panels, inverters, batteries, renewable energy')

@section('content')
    @include('frontend.sections.page-header', [
        'title' => 'Our Products',
        'breadcrumbs' => [
            ['label' => 'Home', 'url' => route('home')],
            ['label' => 'Products', 'url' => null]
        ]
    ])

    @include('frontend.sections.products-list')
@endsection

@push('scripts')
<script>
    if (typeof WOW !== 'undefined') new WOW().init();
</script>
@endpush