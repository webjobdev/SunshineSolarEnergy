@php
    $productName   = $product->name             ?? '';
    $productSlug   = $product->slug             ?? '';
    $mainImage     = $product->thumbnail_url    ?? null;
    $galleryImages = $product->galleries        ?? collect();
    $price         = $product->price            ?? null;
    $shortDesc     = $product->short_description ?? '';
    $description   = $product->description      ?? '';
    $categoryId    = $product->category_id      ?? null;
    $categoryName  = $product->category->name   ?? '';
    $brandId       = $product->brand_id         ?? null;
    $brandName     = $product->brand->name      ?? '';
@endphp

<!-- Product Single Page Start -->
<div class="page-product-single">
    <div class="container">
        <div class="row">
            {{-- Images --}}
            <div class="col-lg-7">
                <div class="product-images">
                    <div class="product-main-image">
                        <figure>
                            @if($mainImage)
                                <img id="mainProductImage" src="{{ $mainImage }}" alt="{{ $productName }}">
                            @else
                                <img id="mainProductImage" src="{{ asset('frontend/images/products/placeholder.jpg') }}" alt="{{ $productName }}">
                            @endif
                        </figure>
                    </div>

                    @if($galleryImages->count() > 0)
                        <div class="product-thumbnails">
                            @if($mainImage)
                                <img src="{{ $mainImage }}"
                                     alt="{{ $productName }}"
                                     class="thumb active"
                                     data-full="{{ $mainImage }}">
                            @endif
                            @foreach($galleryImages as $gallery)
                                <img src="{{ $gallery->image_url }}"
                                     alt="{{ $productName }}"
                                     class="thumb"
                                     data-full="{{ $gallery->image_url }}">
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>

            {{-- Info --}}
            <div class="col-lg-5">
                <div class="product-info">
                    @if($categoryName)
                        <div class="product-category">
                            <a href="{{ route('products', ['categories' => [$categoryId]]) }}">{{ $categoryName }}</a>
                        </div>
                    @endif

                    <h1 class="product-title">{{ $productName }}</h1>

                    @if($price)
                        <div class="product-price-box">
                            <span class="price">${{ number_format((float) $price, 2) }}</span>
                        </div>
                    @endif

                    @if($shortDesc)
                        <div class="product-description-short">
                            <p>{{ $shortDesc }}</p>
                        </div>
                    @endif

                    {{-- WhatsApp Enquiry --}}
                    <div class="product-cart-actions">
                        <a href="{{ productWhatsappUrl($product) }}"
                           target="_blank"
                           rel="noopener"
                           class="btn-whatsapp btn-lg w-100">
                            <i class="fa-brands fa-whatsapp"></i>
                            Enquire on WhatsApp
                        </a>
                    </div>

                    {{-- Meta --}}
                    <div class="product-meta">
                        @if($categoryName)
                            <div class="meta-item">
                                <span class="meta-label">Category:</span>
                                <span class="meta-value">
                                    <a href="{{ route('products', ['categories' => [$categoryId]]) }}">{{ $categoryName }}</a>
                                </span>
                            </div>
                        @endif
                        @if($brandName)
                            <div class="meta-item">
                                <span class="meta-label">Brand:</span>
                                <span class="meta-value">
                                    <a href="{{ route('products', ['brands' => [$brandId]]) }}">{{ $brandName }}</a>
                                </span>
                            </div>
                        @endif
                    </div>

                    {{-- Share --}}
                    <div class="product-share">
                        <span>Share:</span>
                        <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}" target="_blank"><i class="fa-brands fa-facebook-f"></i></a>
                        <a href="https://twitter.com/intent/tweet?url={{ urlencode(url()->current()) }}" target="_blank"><i class="fa-brands fa-twitter"></i></a>
                        <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ urlencode(url()->current()) }}" target="_blank"><i class="fa-brands fa-linkedin-in"></i></a>
                        <a href="{{ whatsappUrl('Check out: ' . $productName . ' - ' . url()->current()) }}" target="_blank"><i class="fa-brands fa-whatsapp"></i></a>
                    </div>
                </div>
            </div>
        </div>

        {{-- Tabs --}}
        <div class="row">
            <div class="col-lg-12">
                <div class="product-tabs">
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item">
                            <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#description" type="button">Description</button>
                        </li>
                    </ul>

                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="description">
                            <div class="product-description">
                                {!! $description ?: '<p>No description available.</p>' !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Product Single Page End -->

@push('styles')
<style>
    .page-product-single .btn-whatsapp {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        background: #25D366;
        color: #fff !important;
        padding: 14px 24px;
        border-radius: 8px;
        font-size: 16px;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.2s ease;
        border: none;
    }
    .page-product-single .btn-whatsapp:hover {
        background: #128C7E;
        color: #fff !important;
        transform: translateY(-2px);
        box-shadow: 0 6px 16px rgba(37, 211, 102, 0.35);
    }
    .page-product-single .product-cart-actions {
        margin: 20px 0;
    }
    .page-product-single .product-thumbnails {
        display: flex;
        gap: 10px;
        margin-top: 15px;
        flex-wrap: wrap;
    }
    .page-product-single .product-thumbnails img {
        width: 80px;
        height: 80px;
        object-fit: cover;
        border-radius: 6px;
        cursor: pointer;
        border: 2px solid transparent;
        transition: border-color 0.2s;
    }
    .page-product-single .product-thumbnails img:hover,
    .page-product-single .product-thumbnails img.active {
        border-color: #25D366;
    }
</style>
@endpush

@push('scripts')
<script>
$(document).ready(function () {
    $('.product-thumbnails .thumb').on('click', function () {
        $('#mainProductImage').attr('src', $(this).data('full'));
        $('.product-thumbnails .thumb').removeClass('active');
        $(this).addClass('active');
    });
});
</script>
@endpush