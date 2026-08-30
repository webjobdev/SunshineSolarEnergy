<!-- Product Single Page Start -->
<div class="page-product-single">
    <div class="container">
        <div class="row">
            <div class="col-lg-7">
                <!-- Product Images -->
                <div class="product-images">
                    <!-- Main Image -->
                    <div class="product-main-image">
                        <figure>
                            <img src="{{ asset('frontend/images/products/'.$product->main_image ?? $product['main_image'] ?? 'product-main.jpg') }}" 
                                 alt="{{ $product->name ?? 'Product' }}">
                        </figure>
                    </div>
                    
                    <!-- Thumbnails Gallery -->
                    @if(isset($product->gallery) && count($product->gallery) > 0)
                        <div class="product-thumbnails">
                            @foreach($product->gallery as $galleryImage)
                                <img src="{{ asset('frontend/images/products/'.$galleryImage) }}" 
                                     alt="{{ $product->name ?? 'Product' }}"
                                     class="{{ $loop->first ? 'active' : '' }}">
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
            
            <div class="col-lg-5">
                <!-- Product Info -->
                <div class="product-info">
                    <!-- Product Category -->
                    <div class="product-category">
                        <a href="{{ route('products', ['categories' => [$product->category_id ?? '']]) }}">
                            {{ $product->category_name ?? $product['category_name'] ?? 'Category' }}
                        </a>
                    </div>
                    
                    <!-- Product Title -->
                    <h1 class="product-title">{{ $product->name ?? $product['name'] }}</h1>
                    
                    <!-- Product Rating -->
                    <div class="product-rating">
                        @for($i = 1; $i <= 5; $i++)
                            <i class="fa-solid fa-star {{ $i <= ($product->rating ?? $product['rating'] ?? 4) ? 'active' : '' }}"></i>
                        @endfor
                        <span class="rating-count">({{ $product->reviews_count ?? $product['reviews_count'] ?? 0 }} reviews)</span>
                    </div>
                    
                    <!-- Product Price -->
                    <div class="product-price-box">
                        @if(isset($product->sale_price) || isset($product['sale_price']))
                            <span class="sale-price">${{ number_format($product->sale_price ?? $product['sale_price'], 2) }}</span>
                            <span class="regular-price">${{ number_format($product->price ?? $product['price'], 2) }}</span>
                            <span class="discount-badge">
                                {{ round((($product->price ?? $product['price'] - $product->sale_price ?? $product['sale_price']) / ($product->price ?? $product['price'])) * 100) }}% OFF
                            </span>
                        @else
                            <span class="price">${{ number_format($product->price ?? $product['price'], 2) }}</span>
                        @endif
                    </div>
                    
                    <!-- Short Description -->
                    <div class="product-description-short">
                        <p>{{ $product->short_description ?? $product['short_description'] ?? 'High-quality solar product designed for maximum efficiency and durability.' }}</p>
                    </div>
                    
                    <!-- Product Options -->
                    <div class="product-options">
                        @if(isset($product->variations) && count($product->variations) > 0)
                            <div class="option-group">
                                <label>Color</label>
                                <div class="color-options">
                                    @foreach($product->variations['colors'] ?? [] as $color)
                                        <button class="color-btn" style="background: {{ $color }}"></button>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    </div>
                    
                    <!-- Quantity and Add to Cart -->
                    <div class="product-cart-actions">
                        <div class="quantity-selector">
                            <button class="qty-btn qty-btn-minus">-</button>
                            <input type="number" class="qty-input" value="1" min="1" max="99">
                            <button class="qty-btn qty-btn-plus">+</button>
                        </div>
                        <button class="add-to-cart-btn btn-default" data-id="{{ $product->id ?? $product['id'] }}">
                            <i class="fa-solid fa-cart-plus"></i> Add to Cart
                        </button>
                    </div>
                    
                    <!-- Product Meta -->
                    <div class="product-meta">
                        <div class="meta-item">
                            <span class="meta-label">SKU:</span>
                            <span class="meta-value">{{ $product->sku ?? $product['sku'] ?? 'N/A' }}</span>
                        </div>
                        <div class="meta-item">
                            <span class="meta-label">Category:</span>
                            <span class="meta-value">
                                <a href="{{ route('products', ['categories' => [$product->category_id ?? '']]) }}">
                                    {{ $product->category_name ?? $product['category_name'] ?? 'N/A' }}
                                </a>
                            </span>
                        </div>
                        <div class="meta-item">
                            <span class="meta-label">Brand:</span>
                            <span class="meta-value">
                                <a href="{{ route('products', ['brands' => [$product->brand_id ?? '']]) }}">
                                    {{ $product->brand_name ?? $product['brand_name'] ?? 'N/A' }}
                                </a>
                            </span>
                        </div>
                    </div>
                    
                    <!-- Share -->
                    <div class="product-share">
                        <span>Share:</span>
                        <a href="#"><i class="fa-brands fa-facebook-f"></i></a>
                        <a href="#"><i class="fa-brands fa-twitter"></i></a>
                        <a href="#"><i class="fa-brands fa-linkedin-in"></i></a>
                        <a href="#"><i class="fa-brands fa-instagram"></i></a>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Product Description Tabs -->
        <div class="row">
            <div class="col-lg-12">
                <div class="product-tabs">
                    <ul class="nav nav-tabs" id="productTabs" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="description-tab" data-bs-toggle="tab" 
                                    data-bs-target="#description" type="button" role="tab">
                                Description
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="specifications-tab" data-bs-toggle="tab" 
                                    data-bs-target="#specifications" type="button" role="tab">
                                Specifications
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="reviews-tab" data-bs-toggle="tab" 
                                    data-bs-target="#reviews" type="button" role="tab">
                                Reviews ({{ $product->reviews_count ?? $product['reviews_count'] ?? 0 }})
                            </button>
                        </li>
                    </ul>
                    
                    <div class="tab-content" id="productTabsContent">
                        <!-- Description Tab -->
                        <div class="tab-pane fade show active" id="description" role="tabpanel">
                            <div class="product-description">
                                {!! $product->description ?? $product['description'] ?? '<p>Detailed product description goes here...</p>' !!}
                            </div>
                            
                            <!-- Product Gallery -->
                            @if(isset($product->gallery) && count($product->gallery) > 1)
                                <div class="product-gallery">
                                    <h3>Product Gallery</h3>
                                    <div class="gallery-grid">
                                        @foreach($product->gallery as $galleryImage)
                                            <div class="gallery-item">
                                                <a href="{{ asset('frontend/images/products/'.$galleryImage) }}" class="popup-image">
                                                    <img src="{{ asset('frontend/images/products/'.$galleryImage) }}" 
                                                         alt="{{ $product->name ?? 'Product' }}">
                                                </a>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                        </div>
                        
                        <!-- Specifications Tab -->
                        <div class="tab-pane fade" id="specifications" role="tabpanel">
                            <div class="product-specifications">
                                <table class="specs-table">
                                    @foreach($product->specifications ?? $product['specifications'] ?? [] as $spec)
                                        <tr>
                                            <th>{{ $spec['label'] }}</th>
                                            <td>{{ $spec['value'] }}</td>
                                        </tr>
                                    @endforeach
                                </table>
                            </div>
                        </div>
                        
                        <!-- Reviews Tab -->
                        <div class="tab-pane fade" id="reviews" role="tabpanel">
                            <div class="product-reviews">
                                @forelse($product->reviews ?? $product['reviews'] ?? [] as $review)
                                    <div class="review-item">
                                        <div class="review-header">
                                            <div class="reviewer-info">
                                                <strong>{{ $review['author'] }}</strong>
                                                <span class="review-date">{{ $review['date'] }}</span>
                                            </div>
                                            <div class="review-rating">
                                                @for($i = 1; $i <= 5; $i++)
                                                    <i class="fa-solid fa-star {{ $i <= $review['rating'] ? 'active' : '' }}"></i>
                                                @endfor
                                            </div>
                                        </div>
                                        <div class="review-body">
                                            <p>{{ $review['content'] }}</p>
                                        </div>
                                    </div>
                                @empty
                                    <p>No reviews yet. Be the first to review this product!</p>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Product Single Page End -->