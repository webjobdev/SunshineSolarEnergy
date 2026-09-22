@extends('frontend.layouts.app')

@section('title', $aboutPage->meta_title ?? ($about->title ?? 'About Us') . ' - ' . configSetting('web_name', 'Our Store'))
@section('meta_description', $aboutPage->meta_description ?? \Illuminate\Support\Str::limit(strip_tags($about->description ?? ''), 160))
@section('meta_keywords', $aboutPage->meta_keywords ?? 'about us, solar energy, renewable energy, green energy')

@section('content')
    @include('frontend.sections.page-header', [
        'title' => 'About Us',
        'breadcrumbs' => [
            ['label' => 'Home', 'url' => route('home')],
            ['label' => 'About Us', 'url' => null]
        ]
    ])

    @include('frontend.sections.about-details', ['about' => $about])

    @include('frontend.sections.why-choose')

    @include('frontend.sections.process')

    @include('frontend.sections.infobar')

    @include('frontend.sections.latest-projects')

    @include('frontend.sections.counter')

    @include('frontend.sections.testimonials')

    @include('frontend.sections.team')
@endsection

@push('scripts')
<script>
    if (typeof WOW !== 'undefined') new WOW().init();

    $(document).ready(function () {
        if ($.fn.counterUp) {
            $('.counter').counterUp({ delay: 10, time: 1000 });
        }
    });
</script>
@endpush