@php
    $productName   = $product->name              ?? '';
    $productSlug   = $product->slug              ?? '';
    $mainImage     = $product->thumbnail_url     ?? null;
    $galleryImages = $product->galleries         ?? collect();
    $price         = $product->price             ?? null;
    $shortDesc     = $product->short_description ?? '';
    $description   = $product->description       ?? '';
    $categoryId    = $product->category_id       ?? null;
    $categoryName  = $product->category->name    ?? '';
    $brandId       = $product->brand_id          ?? null;
    $brandName     = $product->brand->name       ?? '';
    $isNew         = ($product->new      ?? '') === 'active';
    $isTrending    = ($product->trending ?? '') === 'active';
@endphp

<div class="page-product-single">
    <div class="container">

        <div class="product-back-row">
            <a href="{{ route('products') }}" class="back-link">
                <i class="fa-solid fa-arrow-left"></i>
                <span>Back to Products</span>
            </a>
        </div>

        <div class="row g-4">

            {{-- Gallery --}}
            <div class="col-lg-6">
                <div class="product-gallery-card">
                    @if($isNew || $isTrending)
                        <div class="gallery-badges">
                            @if($isNew)
                                <span class="g-badge g-badge-new">New</span>
                            @endif
                            @if($isTrending)
                                <span class="g-badge g-badge-trending">Trending</span>
                            @endif
                        </div>
                    @endif

                    <div class="product-main-image">
                        @if($mainImage)
                            <img id="mainProductImage" src="{{ $mainImage }}" alt="{{ $productName }}">
                        @else
                            <img id="mainProductImage"
                                 src="{{ asset('frontend/images/products/placeholder.jpg') }}"
                                 alt="{{ $productName }}">
                        @endif
                    </div>

                    @if($galleryImages->count() > 0 || $mainImage)
                        <div class="product-thumbnails">
                            @if($mainImage)
                                <button type="button" class="thumb-btn active" data-full="{{ $mainImage }}">
                                    <img src="{{ $mainImage }}" alt="{{ $productName }}">
                                </button>
                            @endif
                            @foreach($galleryImages as $gallery)
                                <button type="button" class="thumb-btn" data-full="{{ $gallery->image_url }}">
                                    <img src="{{ $gallery->image_url }}" alt="{{ $productName }}">
                                </button>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>

            {{-- Info --}}
            <div class="col-lg-6">
                <div class="product-info-card">

                    @if($categoryName)
                        <a href="{{ route('products', ['categories' => [$categoryId]]) }}"
                           class="product-category-pill">
                            {{ $categoryName }}
                        </a>
                    @endif

                    <h1 class="product-name">{{ $productName }}</h1>

                    @if($price)
                        <div class="product-price-row">
                            <span class="product-price">₹{{ number_format((float) $price, 2) }}</span>
                        </div>
                    @endif

                    @if($shortDesc)
                        <p class="product-short-desc">{{ $shortDesc }}</p>
                    @endif

                    <div class="product-meta-table">
                        @if($categoryName)
                            <div class="meta-row">
                                <span class="meta-key">Category</span>
                                <span class="meta-val">
                                    <a href="{{ route('products', ['categories' => [$categoryId]]) }}">
                                        {{ $categoryName }}
                                    </a>
                                </span>
                            </div>
                        @endif
                        @if($brandName)
                            <div class="meta-row">
                                <span class="meta-key">Brand</span>
                                <span class="meta-val">
                                    <a href="{{ route('products', ['brands' => [$brandId]]) }}">
                                        {{ $brandName }}
                                    </a>
                                </span>
                            </div>
                        @endif
                        @if($product->created_at)
                            <div class="meta-row">
                                <span class="meta-key">Added</span>
                                <span class="meta-val">{{ $product->created_at->format('M d, Y') }}</span>
                            </div>
                        @endif
                    </div>

                    <div class="product-cta">
                        <a href="{{ productWhatsappUrl($product) }}"
                           target="_blank"
                           rel="noopener"
                           class="btn-enquire">
                            <i class="fa-brands fa-whatsapp"></i>
                            <span>Enquire on WhatsApp</span>
                        </a>
                    </div>

                    <div class="product-share-row">
                        <span class="share-label">Share this product</span>
                        <div class="share-buttons">
                            <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}"
                               target="_blank" rel="noopener" aria-label="Share on Facebook">
                                <i class="fa-brands fa-facebook-f"></i>
                            </a>
                            <a href="https://twitter.com/intent/tweet?url={{ urlencode(url()->current()) }}"
                               target="_blank" rel="noopener" aria-label="Share on Twitter">
                                <i class="fa-brands fa-twitter"></i>
                            </a>
                            <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ urlencode(url()->current()) }}"
                               target="_blank" rel="noopener" aria-label="Share on LinkedIn">
                                <i class="fa-brands fa-linkedin-in"></i>
                            </a>
                            <a href="{{ whatsappUrl('Check out: ' . $productName . ' - ' . url()->current()) }}"
                               target="_blank" rel="noopener" aria-label="Share on WhatsApp">
                                <i class="fa-brands fa-whatsapp"></i>
                            </a>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        {{-- Description --}}
        @if($description)
            <div class="row mt-4">
                <div class="col-12">
                    <div class="product-description-card">
                        <div class="desc-heading">
                            <span class="heading-bar"></span>
                            <h2>Product Description</h2>
                        </div>
                        <div class="product-description-body">
                            {!! $description !!}
                        </div>
                    </div>
                </div>
            </div>
        @endif

    </div>
</div>

@push('styles')
<style>
/* =========================================================
   PRODUCT SINGLE
   ========================================================= */
.page-product-single {
    padding: 30px 0 60px;
    background: #fafbfc;
}

.product-back-row { margin-bottom: 20px; }

.back-link {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    font-size: 14px;
    font-weight: 600;
    color: #666;
    background: #fff;
    border: 1px solid #f1f1f1;
    padding: 10px 18px;
    border-radius: 10px;
    text-decoration: none;
    transition: all 0.2s;
}

.back-link:hover {
    color: #28a745;
    border-color: #28a745;
    transform: translateX(-3px);
    box-shadow: 0 4px 12px rgba(40, 167, 69, 0.12);
}

/* Gallery card */
.product-gallery-card {
    position: relative;
    background: #fff;
    border: 1px solid #f1f1f1;
    border-radius: 16px;
    padding: 20px;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.04);
}

.gallery-badges {
    position: absolute;
    top: 30px;
    left: 30px;
    display: flex;
    gap: 6px;
    z-index: 2;
}

.g-badge {
    display: inline-block;
    padding: 5px 12px;
    border-radius: 20px;
    font-size: 11px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    color: #fff;
}

.g-badge-new      { background: #0d6efd; }
.g-badge-trending { background: #fd7e14; }

.product-main-image {
    display: flex;
    align-items: center;
    justify-content: center;
    aspect-ratio: 1 / 1;
    background: #f8f9fa;
    border-radius: 12px;
    overflow: hidden;
    padding: 15px;
}

.product-main-image img {
    max-width: 100%;
    max-height: 100%;
    object-fit: contain;
    transition: opacity 0.25s;
}

/* Thumbnails */
.product-thumbnails {
    display: flex;
    gap: 10px;
    margin-top: 16px;
    flex-wrap: wrap;
}

.thumb-btn {
    width: 74px;
    height: 74px;
    padding: 4px;
    border: 2px solid transparent;
    border-radius: 12px;
    background: #f8f9fa;
    cursor: pointer;
    transition: all 0.2s;
    overflow: hidden;
    display: flex;
    align-items: center;
    justify-content: center;
}

.thumb-btn img {
    max-width: 100%;
    max-height: 100%;
    object-fit: contain;
    border-radius: 8px;
}

.thumb-btn:hover {
    transform: translateY(-3px);
    border-color: #cfe9d6;
}

.thumb-btn.active {
    border-color: #25D366;
    background: #e6f4ea;
}

/* Info card */
.product-info-card {
    background: #fff;
    border: 1px solid #f1f1f1;
    border-radius: 16px;
    padding: 28px;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.04);
    height: 100%;
    display: flex;
    flex-direction: column;
}

.product-category-pill {
    display: inline-block;
    align-self: flex-start;
    font-size: 11px;
    text-transform: uppercase;
    letter-spacing: 0.7px;
    font-weight: 700;
    color: #28a745;
    background: #e6f4ea;
    padding: 6px 14px;
    border-radius: 20px;
    text-decoration: none;
    margin-bottom: 14px;
    transition: all 0.2s;
}

.product-category-pill:hover {
    background: #28a745;
    color: #fff;
    transform: translateY(-1px);
}

.product-name {
    font-size: 30px;
    font-weight: 700;
    line-height: 1.25;
    color: #1a1a1a;
    margin: 0 0 16px;
    letter-spacing: -0.3px;
}

.product-price-row {
    margin-bottom: 18px;
    padding-bottom: 18px;
    border-bottom: 1px solid #f5f5f5;
}

.product-price {
    font-size: 34px;
    font-weight: 800;
    color: #28a745;
    letter-spacing: -0.8px;
}

.product-short-desc {
    font-size: 15px;
    line-height: 1.7;
    color: #666;
    margin: 0 0 22px;
}

.product-meta-table {
    border-top: 1px solid #f5f5f5;
    border-bottom: 1px solid #f5f5f5;
    padding: 14px 0;
    margin-bottom: 22px;
}

.meta-row {
    display: flex;
    align-items: center;
    gap: 14px;
    padding: 7px 0;
    font-size: 14px;
}

.meta-key {
    color: #999;
    min-width: 90px;
    font-weight: 500;
}

.meta-val {
    color: #333;
    font-weight: 500;
}

.meta-val a {
    color: #28a745;
    text-decoration: none;
    font-weight: 600;
    transition: color 0.2s;
}

.meta-val a:hover {
    color: #128C7E;
    text-decoration: underline;
}

.product-cta { margin-bottom: 22px; }

.btn-enquire {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 12px;
    width: 100%;
    background: #25D366;
    color: #fff !important;
    padding: 16px 24px;
    border-radius: 12px;
    font-size: 16px;
    font-weight: 700;
    text-decoration: none;
    transition: all 0.25s ease;
    box-shadow: 0 6px 18px rgba(37, 211, 102, 0.28);
    border: none;
}

.btn-enquire:hover {
    background: #128C7E;
    color: #fff !important;
    transform: translateY(-3px);
    box-shadow: 0 10px 26px rgba(37, 211, 102, 0.38);
}

.btn-enquire i { font-size: 22px; }

.product-share-row {
    margin-top: auto;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 12px;
    padding-top: 18px;
    border-top: 1px solid #f5f5f5;
}

.share-label {
    font-size: 13px;
    color: #999;
    font-weight: 500;
}

.share-buttons {
    display: flex;
    gap: 8px;
}

.share-buttons a {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 38px;
    height: 38px;
    border-radius: 50%;
    background: #f5f5f5;
    color: #555;
    text-decoration: none;
    transition: all 0.2s;
    font-size: 14px;
}

.share-buttons a:hover {
    background: #28a745;
    color: #fff;
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(40, 167, 69, 0.3);
}

/* Description */
.product-description-card {
    background: #fff;
    border: 1px solid #f1f1f1;
    border-radius: 16px;
    padding: 30px;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.04);
}

.desc-heading {
    display: flex;
    align-items: center;
    gap: 12px;
    margin-bottom: 20px;
    padding-bottom: 16px;
    border-bottom: 2px solid #f0f0f0;
}

.heading-bar {
    display: inline-block;
    width: 4px;
    height: 24px;
    background: #28a745;
    border-radius: 2px;
}

.desc-heading h2 {
    font-size: 22px;
    font-weight: 700;
    color: #1a1a1a;
    margin: 0;
}

.product-description-body {
    font-size: 15px;
    line-height: 1.85;
    color: #444;
}

.product-description-body > *:first-child { margin-top: 0; }
.product-description-body > *:last-child  { margin-bottom: 0; }
.product-description-body p               { margin: 0 0 14px; }
.product-description-body h1,
.product-description-body h2,
.product-description-body h3,
.product-description-body h4 {
    color: #1a1a1a;
    font-weight: 700;
    margin: 24px 0 12px;
    line-height: 1.35;
}
.product-description-body h1 { font-size: 26px; }
.product-description-body h2 { font-size: 22px; }
.product-description-body h3 { font-size: 19px; }
.product-description-body h4 { font-size: 17px; }
.product-description-body img {
    max-width: 100%;
    height: auto;
    border-radius: 10px;
    margin: 14px 0;
}
.product-description-body ul,
.product-description-body ol {
    padding-left: 22px;
    margin: 0 0 14px;
}
.product-description-body li { margin-bottom: 6px; }

.product-description-body blockquote {
    border-left: 4px solid #28a745;
    background: #f7fbf9;
    padding: 14px 20px;
    margin: 16px 0;
    border-radius: 6px;
    color: #555;
    font-style: italic;
}

.product-description-body table {
    width: 100%;
    border-collapse: collapse;
    margin: 18px 0;
    font-size: 14px;
}

.product-description-body table td,
.product-description-body table th {
    border: 1px solid #e5e5e5;
    padding: 10px 14px;
}

.product-description-body table th {
    background: #f8f9fa;
    font-weight: 600;
    text-align: left;
}

.product-description-body a {
    color: #28a745;
    text-decoration: underline;
}

/* Responsive */
@media (max-width: 991px) {
    .page-product-single  { padding: 20px 0 40px; }
    .product-name         { font-size: 24px; }
    .product-price        { font-size: 28px; }
    .product-info-card,
    .product-gallery-card,
    .product-description-card { padding: 22px; }
    .desc-heading h2      { font-size: 19px; }
}

@media (max-width: 575px) {
    .page-product-single  { padding: 15px 0 30px; }
    .product-back-row     { margin-bottom: 14px; }
    .back-link            { font-size: 13px; padding: 8px 14px; }
    .product-gallery-card,
    .product-info-card,
    .product-description-card { padding: 16px; border-radius: 12px; }
    .gallery-badges       { top: 22px; left: 22px; }
    .product-name         { font-size: 20px; margin-bottom: 12px; }
    .product-price        { font-size: 24px; }
    .product-price-row    { margin-bottom: 14px; padding-bottom: 14px; }
    .product-short-desc   { font-size: 14px; margin-bottom: 16px; }
    .product-meta-table   { padding: 10px 0; margin-bottom: 16px; }
    .meta-row             { font-size: 13px; padding: 5px 0; }
    .meta-key             { min-width: 75px; }
    .btn-enquire          { font-size: 15px; padding: 14px 20px; gap: 10px; }
    .btn-enquire i        { font-size: 18px; }
    .thumb-btn            { width: 60px; height: 60px; }
    .product-share-row    { flex-direction: column; align-items: flex-start; gap: 10px; }
    .product-description-body { font-size: 14px; }
    .desc-heading h2      { font-size: 17px; }
}
</style>
@endpush

@push('scripts')
<script>
$(document).ready(function () {
    $('.product-thumbnails .thumb-btn').on('click', function () {
        var fullSrc = $(this).data('full');
        $('#mainProductImage').fadeTo(120, 0.3, function () {
            $(this).attr('src', fullSrc).fadeTo(120, 1);
        });
        $('.product-thumbnails .thumb-btn').removeClass('active');
        $(this).addClass('active');
    });
});
</script>
@endpush