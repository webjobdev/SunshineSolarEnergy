@extends('frontend.layouts.app')

@section('title', 'Solor - Solar & Renewable Energy')

@section('content')
    <!-- Hero Section -->
    @include('frontend.sections.hero')
    
    <!-- About Section -->
    @include('frontend.sections.about')
    
    <!-- Services Section -->
    @include('frontend.sections.services')s
    
    <!-- Process Section -->
    @include('frontend.sections.process')
    
    <!-- Video Section -->
    @include('frontend.sections.video')
    
    <!-- Skills Section -->
    @include('frontend.sections.skills')
    
    <!-- Infobar Section -->
    @include('frontend.sections.infobar')
    
    <!-- Why Choose Us -->
    @include('frontend.sections.why-choose')
    
    <!-- Counter Section -->
    @include('frontend.sections.counter')
    
    <!-- Calculator Section -->
    @include('frontend.sections.calculator')
    
    <!-- Latest News -->
    @include('frontend.sections.latest-news')
@endsection