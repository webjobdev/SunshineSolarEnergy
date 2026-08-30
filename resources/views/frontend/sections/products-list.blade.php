<!-- Products Page Start -->
<div class="page-products">
    <div class="container">
        <div class="row">
            <!-- Sidebar with Filters -->
            <div class="col-lg-3">
                @include('frontend.sections.products-sidebar')
            </div>
            
            <!-- Products Grid -->
            <div class="col-lg-9">
                <!-- Products Header -->
                <div class="products-header wow fadeInUp">
                    <div class="row align-items-center">
                        <div class="col-md-6">
                            <p class="products-count">Showing {{ $products->firstItem() ?? 0 }}-{{ $products->lastItem() ?? 0 }} of {{ $products->total() ?? 0 }} products</p>
                        </div>
                        <div class="col-md-6">
                            <div class="products-sort">
                                <label for="sort">Sort by:</label>
                                <select id="sort" class="form-control" onchange="window.location.href=this.value">
                                    <option value="{{ route('products', ['sort' => 'newest']) }}" {{ request('sort') == 'newest' ? 'selected' : '' }}>Newest</option>
                                    <option value="{{ route('products', ['sort' => 'price_low']) }}" {{ request('sort') == 'price_low' ? 'selected' : '' }}>Price: Low to High</option>
                                    <option value="{{ route('products', ['sort' => 'price_high']) }}" {{ request('sort') == 'price_high' ? 'selected' : '' }}>Price: High to Low</option>
                                    <option value="{{ route('products', ['sort' => 'popular']) }}" {{ request('sort') == 'popular' ? 'selected' : '' }}>Popular</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Products Grid -->
                <div class="row products-grid">
                    @forelse($products as $product)
                        <div class="col-lg-4 col-md-6">
                            @include('frontend.sections.product-item', ['product' => $product])
                        </div>
                    @empty
                        <div class="col-12">
                            <div class="no-products text-center">
                                <h3>No products found</h3>
                                <p>Try adjusting your filters</p>
                            </div>
                        </div>
                    @endforelse
                </div>

                <!-- Pagination -->
                @if($products->hasPages())
                    <div class="row">
                        <div class="col-md-12">
                            <div class="post-pagination wow fadeInUp">
                                {{ $products->appends(request()->query())->links('frontend.pagination.custom') }}
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
<!-- Products Page End -->