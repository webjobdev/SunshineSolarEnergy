<!-- Product Item Start -->
<div class="product-item wow fadeInUp" data-wow-delay="{{ $loop->iteration * 0.1 }}s">
    <div class="product-image">
        <a href="{{ route('product.single', $product->slug ?? $product['slug']) }}">
            <figure>
                {{-- <img src="{{ asset('frontend/images/products/'.$product->image ?? $product['image']) }}" 
                     alt="{{ $product->name ?? $product['name'] }}"> --}}
                     <img src="#" 
                     alt="{{ $product->name ?? $product['name'] }}">
            </figure>
        </a>
        
        <!-- Badge -->
        @if(isset($product->badge) || isset($product['badge']))
            <span class="product-badge {{ $product->badge_type ?? $product['badge_type'] ?? 'sale' }}">
                {{ $product->badge ?? $product['badge'] }}
            </span>
        @endif
        
        <!-- Wishlist Button -->
        <button class="wishlist-btn" title="Add to Wishlist">
            <i class="fa-regular fa-heart"></i>
        </button>
    </div>

    <div class="product-content">
        <div class="product-category">
            <a href="{{ route('products', ['categories' => [$product->category_id ?? $product['category_id']]]) }}">
                {{ $product->category_name ?? $product['category_name'] }}
            </a>
        </div>
        
        <h3>
            <a href="{{ route('product.single', $product->slug ?? $product['slug']) }}">
                {{ $product->name ?? $product['name'] }}
            </a>
        </h3>
        
        <!-- Rating -->
        <div class="product-rating">
            @for($i = 1; $i <= 5; $i++)
                <i class="fa-solid fa-star {{ $i <= ($product->rating ?? $product['rating'] ?? 4) ? 'active' : '' }}"></i>
            @endfor
            <span class="rating-count">({{ $product->reviews_count ?? $product['reviews_count'] ?? 0 }})</span>
        </div>
        
        <!-- Price -->
        <div class="product-price">
            @if(isset($product->sale_price) || isset($product['sale_price']))
                <span class="sale-price">${{ number_format($product->sale_price ?? $product['sale_price'], 2) }}</span>
                <span class="regular-price">${{ number_format($product->price ?? $product['price'], 2) }}</span>
            @else
                <span class="price">${{ number_format($product->price ?? $product['price'], 2) }}</span>
            @endif
        </div>
        
        <!-- Add to Cart -->
        <div class="product-actions">
            <a href="{{ route('product.single', $product->slug ?? $product['slug']) }}" class="btn-default btn-sm">
                View Details
            </a>
            <button class="btn-cart" data-id="{{ $product->id ?? $product['id'] }}">
                <i class="fa-solid fa-cart-plus"></i>
            </button>
        </div>
    </div>
</div>
<!-- Product Item End -->