@extends('frontend.layouts.app')

@section('title', $servicesPage->meta_title ?? 'Our Services - Solor Solar & Renewable Energy')
@section('meta_description', $servicesPage->meta_description ?? 'Explore our comprehensive solar and renewable energy services')
@section('meta_keywords', $servicesPage->meta_keywords ?? 'solar services, renewable energy, solar maintenance')

@section('content')
    @include('frontend.sections.page-header', [
        'title' => 'Our Services',
        'breadcrumbs' => [
            ['label' => 'Home',     'url' => route('home')],
            ['label' => 'Services', 'url' => null]
        ]
    ])

    @include('frontend.sections.services-list')

    @include('frontend.sections.infobar')

    @include('frontend.sections.why-choose')
@endsection

@push('scripts')
<script>
    if (typeof WOW !== 'undefined') new WOW().init();
</script>
@endpush