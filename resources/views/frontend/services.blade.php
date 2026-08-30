@extends('frontend.layouts.app')

@section('title', $servicesPage->meta_title ?? 'Our Services - Solor Solar & Renewable Energy')
@section('meta_description', $servicesPage->meta_description ?? 'Explore our comprehensive solar and renewable energy services including solar maintenance, energy saving devices, solar PV systems, and more')
@section('meta_keywords', $servicesPage->meta_keywords ?? 'solar services, renewable energy, solar maintenance, energy saving, solar PV, hybrid energy')

@section('content')
    <!-- Page Header -->
    @include('frontend.sections.page-header', [
        'title' => 'Our Services',
        'breadcrumbs' => [
            ['label' => 'Home', 'url' => route('home')],
            ['label' => 'Services', 'url' => null]
        ]
    ])
    
    <!-- Services List -->
    @include('frontend.sections.services-list')
    
    <!-- Infobar/CTA -->
    @include('frontend.sections.infobar')
    
    <!-- Why Choose Us -->
    @include('frontend.sections.why-choose')
@endsection

@push('scripts')
<script>
    // Initialize WOW.js
    new WOW().init();
</script>
@endpush