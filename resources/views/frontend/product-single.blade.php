@extends('frontend.layouts.app')

@section('title', $product->name . ' - ' . configSetting('web_name', 'Our Store'))
@section('meta_description', $product->short_description ?? \Illuminate\Support\Str::limit(strip_tags($product->description ?? ''), 160))
@section('meta_keywords', $product->name . ', ' . ($product->category->name ?? '') . ', ' . ($product->brand->name ?? ''))

@section('content')
    @include('frontend.sections.page-header', [
        'title' => $product->name,
        'breadcrumbs' => [
            ['label' => 'Home',     'url' => route('home')],
            ['label' => 'Products', 'url' => route('products')],
            ['label' => $product->name, 'url' => null],
        ]
    ])

    @include('frontend.sections.product-single-content', ['product' => $product])

    @if(isset($relatedProducts) && $relatedProducts->count() > 0)
        @include('frontend.sections.related-products', ['relatedProducts' => $relatedProducts])
    @endif
@endsection