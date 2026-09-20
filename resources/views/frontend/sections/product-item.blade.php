<!-- Product Item Start -->
@php
    $itemName     = $product->name           ?? '';
    $itemSlug     = $product->slug           ?? '';
    $itemThumb    = $product->thumbnail_url  ?? null;
    $itemPrice    = $product->price          ?? null;
    $itemCategory = $product->category->name ?? '';
    $itemCatId    = $product->category_id    ?? null;
    $itemShort    = $product->short_description ?? '';
@endphp

<div class="product-item wow fadeInUp" data-wow-delay="{{ $loop->iteration * 0.05 }}s">
    <div class="product-image">
        <a href="{{ route('product.single', $itemSlug) }}" class="product-image-link">
            @if($itemThumb)
                <img src="{{ $itemThumb }}" alt="{{ $itemName }}" loading="lazy">
            @else
                <img src="{{ asset('frontend/images/products/placeholder.jpg') }}" alt="{{ $itemName }}" loading="lazy">
            @endif
        </a>

        @if(isset($product->new) && $product->new === 'active')
            <span class="product-badge badge-new">New</span>
        @elseif(isset($product->trending) && $product->trending === 'active')
            <span class="product-badge badge-trending">Trending</span>
        @endif

        <a href="{{ route('product.single', $itemSlug) }}" class="product-quick-view" aria-label="View product">
            <i class="fa-solid fa-arrow-up-right-from-square"></i>
        </a>
    </div>

    <div class="product-content">
        @if($itemCategory)
            <a href="{{ route('products', ['categories' => [$itemCatId]]) }}" class="product-category">
                {{ $itemCategory }}
            </a>
        @endif

        <h3 class="product-title">
            <a href="{{ route('product.single', $itemSlug) }}">{{ $itemName }}</a>
        </h3>

        @if($itemShort)
            <p class="product-excerpt">{{ \Illuminate\Support\Str::limit(strip_tags($itemShort), 70) }}</p>
        @endif

        @if($itemPrice)
            <div class="product-price">
                ₹{{ number_format((float) $itemPrice, 2) }}
            </div>
        @endif

        <div class="product-actions">
            <a href="{{ route('product.single', $itemSlug) }}" class="btn-view">
                <i class="fa-solid fa-eye"></i>
                <span>View</span>
            </a>

            <a href="{{ productWhatsappUrl($product) }}"
               target="_blank"
               rel="noopener"
               class="btn-whatsapp"
               title="Enquire on WhatsApp">
                <i class="fa-brands fa-whatsapp"></i>
                <span>Enquire</span>
            </a>
        </div>
    </div>
</div>
<!-- Product Item End -->

@push('styles')
<style>
/* =========================================================
   PRODUCT CARD
   ========================================================= */
.product-item {
    background: #fff;
    border-radius: 14px;
    overflow: hidden;
    height: 100%;
    display: flex;
    flex-direction: column;
    border: 1px solid #f1f1f1;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.04);
    transition: transform 0.3s ease, box-shadow 0.3s ease, border-color 0.3s ease;
}

.product-item:hover {
    transform: translateY(-5px);
    box-shadow: 0 12px 28px rgba(0, 0, 0, 0.09);
    border-color: #d6efde;
}

.product-item .product-image {
    position: relative;
    background: #f8f9fa;
    overflow: hidden;
    aspect-ratio: 1 / 1;
}

.product-item .product-image-link {
    display: block;
    width: 100%;
    height: 100%;
}

.product-item .product-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block;
    transition: transform 0.5s ease;
}

.product-item:hover .product-image img {
    transform: scale(1.06);
}

.product-item .product-badge {
    position: absolute;
    top: 12px;
    left: 12px;
    padding: 5px 12px;
    border-radius: 20px;
    font-size: 10px;
    font-weight: 800;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    color: #fff;
    z-index: 2;
}

.product-item .badge-new      { background: #0d6efd; }
.product-item .badge-trending { background: #fd7e14; }

.product-item .product-quick-view {
    position: absolute;
    top: 12px;
    right: 12px;
    width: 36px;
    height: 36px;
    background: #fff;
    color: #333;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    text-decoration: none;
    opacity: 0;
    transform: translateY(-8px);
    transition: all 0.25s ease;
    z-index: 2;
    font-size: 12px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.12);
}

.product-item:hover .product-quick-view {
    opacity: 1;
    transform: translateY(0);
}

.product-item .product-quick-view:hover {
    background: #25D366;
    color: #fff;
}

.product-item .product-content {
    padding: 18px;
    display: flex;
    flex-direction: column;
    flex: 1;
}

.product-item .product-category {
    font-size: 11px;
    text-transform: uppercase;
    letter-spacing: 0.7px;
    color: #28a745;
    text-decoration: none;
    font-weight: 700;
    margin-bottom: 8px;
    display: inline-block;
    transition: color 0.2s;
}

.product-item .product-category:hover {
    color: #128C7E;
}

.product-item .product-title {
    font-size: 15px;
    font-weight: 600;
    line-height: 1.4;
    margin: 0 0 8px;
    color: #1a1a1a;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
    min-height: 42px;
}

.product-item .product-title a {
    color: inherit;
    text-decoration: none;
    transition: color 0.2s;
}

.product-item .product-title a:hover {
    color: #28a745;
}

.product-item .product-excerpt {
    font-size: 13px;
    color: #888;
    line-height: 1.5;
    margin: 0 0 12px;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.product-item .product-price {
    font-size: 19px;
    font-weight: 800;
    color: #28a745;
    margin-top: auto;
    margin-bottom: 14px;
    letter-spacing: -0.3px;
}

.product-item .product-actions {
    display: flex;
    gap: 8px;
}

.product-item .btn-view,
.product-item .btn-whatsapp {
    flex: 1;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 6px;
    padding: 10px 12px;
    border-radius: 10px;
    font-size: 13px;
    font-weight: 600;
    text-decoration: none;
    border: none;
    cursor: pointer;
    transition: all 0.2s ease;
    white-space: nowrap;
}

.product-item .btn-view {
    background: #f1f3f5;
    color: #333;
}

.product-item .btn-view:hover {
    background: #e2e6ea;
    color: #111;
    transform: translateY(-1px);
}

.product-item .btn-whatsapp {
    background: #25D366;
    color: #fff !important;
    box-shadow: 0 4px 12px rgba(37, 211, 102, 0.2);
}

.product-item .btn-whatsapp:hover {
    background: #128C7E;
    color: #fff !important;
    transform: translateY(-1px);
    box-shadow: 0 6px 16px rgba(37, 211, 102, 0.3);
}

@media (max-width: 575px) {
    .product-item .product-content { padding: 12px; }
    .product-item .product-title   { font-size: 14px; min-height: 38px; margin-bottom: 6px; }
    .product-item .product-excerpt { display: none; }
    .product-item .product-price   { font-size: 16px; margin-bottom: 10px; }
    .product-item .btn-view,
    .product-item .btn-whatsapp    { padding: 8px 10px; font-size: 12px; gap: 0; }
    .product-item .btn-view span,
    .product-item .btn-whatsapp span { display: none; }
    .product-item .btn-view i,
    .product-item .btn-whatsapp i  { font-size: 14px; }
    .product-item .product-badge   { top: 8px; left: 8px; font-size: 9px; padding: 4px 9px; }
    .product-item .product-quick-view { width: 30px; height: 30px; top: 8px; right: 8px; font-size: 11px; }
}
</style>
@endpush