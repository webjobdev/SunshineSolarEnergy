@extends('frontend.layouts.app')

@section('title', 'Solor - Solar & Renewable Energy')

@section('content')
    {{-- Hero --}}
    @include('frontend.sections.home.hero')

    {{-- Brands Strip --}}
    @if(isset($homeBrands) && $homeBrands->count() > 0)
        @include('frontend.sections.home.brands')
    @endif

    {{-- Trending Products --}}
    @if(isset($trendingProducts) && $trendingProducts->count() > 0)
        @include('frontend.sections.home.trending-products', ['products' => $trendingProducts])
    @endif

    {{-- About --}}
    {{-- @include('frontend.sections.home.about') --}}

    {{-- Categories Strip --}}
    @if(isset($homeCategories) && $homeCategories->count() > 0)
        @include('frontend.sections.home.categories')
    @endif

    {{-- Featured Products Carousel --}}
    {{-- @if(isset($homeProducts) && $homeProducts->count() > 0)
        @include('frontend.sections.home.featured-products', ['products' => $homeProducts])
    @endif --}}
    {{-- Services --}}
    @include('frontend.sections.home.services')

    {{-- New Products --}}
    @if(isset($newProducts) && $newProducts->count() > 0)
        @include('frontend.sections.home.new-products', ['products' => $newProducts])
    @endif

    {{-- Process --}}
    @include('frontend.sections.home.process')

    {{-- Counter --}}
    @include('frontend.sections.home.counter')

    {{-- Video --}}
    {{-- @include('frontend.sections.home.video') --}}

    {{-- Skills --}}
    @include('frontend.sections.home.skills')

    {{-- Infobar --}}
    @include('frontend.sections.home.infobar')

    {{-- Why Choose --}}
    @include('frontend.sections.home.why-choose')

    {{-- Calculator --}}
    {{-- @include('frontend.sections.home.calculator') --}}

    {{-- Latest News --}}
    {{-- @include('frontend.sections.home.latest-news') --}}
@endsection

@push('scripts')
<script>
    if (typeof WOW !== 'undefined') new WOW().init();
</script>
@endpush