@extends('frontend.layouts.app')

@section('title', $contactPage->meta_title ?? 'Contact Us - ' . configSetting('web_name', 'Our Store'))
@section('meta_description', $contactPage->meta_description ?? 'Get in touch with us — quick replies on WhatsApp.')
@section('meta_keywords', $contactPage->meta_keywords ?? 'contact us, solar energy, renewable energy, solar support')

@section('content')
    @include('frontend.sections.page-header', [
        'title' => 'Contact Us',
        'breadcrumbs' => [
            ['label' => 'Home', 'url' => route('home')],
            ['label' => 'Contact Us', 'url' => null]
        ]
    ])

    @include('frontend.sections.contact-information')
    @include('frontend.sections.contact-whatsapp-cta')
    @include('frontend.sections.contact-map')
@endsection

@push('scripts')
<script>
    if (typeof WOW !== 'undefined') new WOW().init();
</script>
@endpush