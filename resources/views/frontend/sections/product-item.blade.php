<!-- Product Item Start -->
@php
    $itemName     = $product->name          ?? ($product['name'] ?? '');
    $itemSlug     = $product->slug          ?? ($product['slug'] ?? '');
    $itemThumb    = $product->thumbnail_url ?? ($product['thumbnail'] ?? null);
    $itemPrice    = $product->price         ?? ($product['price'] ?? null);
    $itemCategory = $product->category->name ?? ($product['category_name'] ?? '');
    $itemCatId    = $product->category_id   ?? ($product['category_id'] ?? null);
@endphp

<div class="product-item wow fadeInUp" data-wow-delay="{{ $loop->iteration * 0.1 }}s">
    <div class="product-image">
        <a href="{{ route('product.single', $itemSlug) }}">
            <figure>
                @if($itemThumb)
                    <img src="{{ $itemThumb }}" alt="{{ $itemName }}">
                @else
                    <img src="{{ asset('frontend/images/products/placeholder.jpg') }}" alt="{{ $itemName }}">
                @endif
            </figure>
        </a>

        @if(isset($product->new) && $product->new === 'active')
            <span class="product-badge new">New</span>
        @elseif(isset($product->trending) && $product->trending === 'active')
            <span class="product-badge sale">Trending</span>
        @endif
    </div>

    <div class="product-content">
        @if($itemCategory)
            <div class="product-category">
                <a href="{{ route('products', ['categories' => [$itemCatId]]) }}">
                    {{ $itemCategory }}
                </a>
            </div>
        @endif

        <h3>
            <a href="{{ route('product.single', $itemSlug) }}">{{ $itemName }}</a>
        </h3>

        @if($itemPrice)
            <div class="product-price">
                <span class="price">${{ number_format((float) $itemPrice, 2) }}</span>
            </div>
        @endif

        <div class="product-actions">
            <a href="{{ route('product.single', $itemSlug) }}" class="btn-default btn-sm">
                View Details
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
@section('styles')
    <style>
        .product-item .btn-whatsapp {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            background: #25D366;
            color: #fff;
            padding: 8px 14px;
            border-radius: 6px;
            font-size: 13px;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.2s ease;
        }

        .product-item .btn-whatsapp:hover {
            background: #128C7E;
            color: #fff;
            transform: translateY(-1px);
        }

        .product-item .product-actions {
            display: flex;
            gap: 8px;
            margin-top: 12px;
        }

        .product-item .product-actions .btn-default {
            flex: 1;
        }
    </style>
@endsection