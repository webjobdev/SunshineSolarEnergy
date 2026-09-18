@extends('frontend.layouts.app')

@section('title', $product->meta_title ?? ($product->name . ' - ' . configSetting('web_name')))
@section('meta_description', $product->meta_description ?? $product->short_description ?? '')
@section('meta_keywords', $product->meta_keywords ?? '')

@section('content')
    @include('frontend.sections.page-header', [
        'title' => $product->name,
        'breadcrumbs' => [
            ['label' => 'Home', 'url' => route('home')],
            ['label' => 'Products', 'url' => route('products')],
            ['label' => $product->name, 'url' => null],
        ],
    ])

    @include('frontend.sections.product-single-content')

    @if(isset($relatedProducts) && $relatedProducts->count() > 0)
        @include('frontend.sections.related-products')
    @endif
@endsection