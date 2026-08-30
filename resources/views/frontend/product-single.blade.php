@extends('frontend.layouts.app')

@section('title', $product->meta_title ?? ($product->name ?? 'Product Details - Solor'))
@section('meta_description', $product->meta_description ?? ($product->short_description ?? ''))
@section('meta_keywords', $product->meta_keywords ?? '')

@section('content')
    <!-- Page Header -->
    @include('frontend.sections.page-header', [
        'title' => $product->name ?? 'Product Details',
        'breadcrumbs' => [
            ['label' => 'Home', 'url' => route('home')],
            ['label' => 'Products', 'url' => route('products')],
            ['label' => $product->name ?? 'Product', 'url' => null]
        ]
    ])
    
    <!-- Product Single Content -->
    @include('frontend.sections.product-single-content')
    
    <!-- Related Products -->
    @if(isset($relatedProducts) && count($relatedProducts) > 0)
        @include('frontend.sections.related-products')
    @endif
@endsection

@push('scripts')
<script>
    // Product image gallery
    $(document).ready(function() {
        // Change main image on thumbnail click
        $('.product-thumbnails img').on('click', function() {
            var src = $(this).attr('src');
            $('.product-main-image img').attr('src', src);
            $('.product-thumbnails img').removeClass('active');
            $(this).addClass('active');
        });
        
        // Quantity controls
        $('.qty-btn-minus').on('click', function() {
            var input = $(this).siblings('.qty-input');
            var val = parseInt(input.val());
            if (val > 1) {
                input.val(val - 1);
            }
        });
        
        $('.qty-btn-plus').on('click', function() {
            var input = $(this).siblings('.qty-input');
            var val = parseInt(input.val());
            input.val(val + 1);
        });
        
        // Add to cart
        $('.add-to-cart-btn').on('click', function() {
            var qty = $('.qty-input').val();
            var productId = $(this).data('id');
            // Add your AJAX cart logic here
            alert('Product added to cart!');
        });
    });
</script>
@endpush