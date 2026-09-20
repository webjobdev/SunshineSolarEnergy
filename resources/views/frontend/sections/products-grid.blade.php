{{-- AJAX Grid Response --}}
<div class="row g-3 g-md-4 products-grid">
    @forelse($products as $product)
        <div class="col-6 col-md-6 col-lg-4">
            @include('frontend.sections.product-item', ['product' => $product])
        </div>
    @empty
        <div class="col-12">
            <div class="no-products text-center py-5">
                <div class="empty-icon">
                    <i class="fa-solid fa-box-open"></i>
                </div>
                <h3 class="mt-3">No Products Found</h3>
                <p class="text-muted mb-4">Try adjusting your filters or search terms</p>
                <button type="button" class="btn-reset-empty"
                        onclick="window.ProductsFilter && window.ProductsFilter.reset()">
                    <i class="fa-solid fa-rotate-right"></i>
                    Reset Filters
                </button>
            </div>
        </div>
    @endforelse
</div>

{{-- Pagination --}}
@if($products->hasPages())
    <div class="row mt-4">
        <div class="col-12">
            <nav class="products-pagination" aria-label="Products pagination">
                <ul class="pagination justify-content-center">
                    {{-- Previous --}}
                    @if($products->onFirstPage())
                        <li class="page-item disabled">
                            <span class="page-link"><i class="fa-solid fa-chevron-left"></i></span>
                        </li>
                    @else
                        <li class="page-item">
                            <a class="page-link" href="#" data-page="{{ $products->currentPage() - 1 }}">
                                <i class="fa-solid fa-chevron-left"></i>
                            </a>
                        </li>
                    @endif

                    {{-- Pages --}}
                    @foreach($products->getUrlRange(max(1, $products->currentPage() - 2), min($products->lastPage(), $products->currentPage() + 2)) as $page => $url)
                        @if($page == $products->currentPage())
                            <li class="page-item active"><span class="page-link">{{ $page }}</span></li>
                        @else
                            <li class="page-item">
                                <a class="page-link" href="#" data-page="{{ $page }}">{{ $page }}</a>
                            </li>
                        @endif
                    @endforeach

                    {{-- Next --}}
                    @if($products->hasMorePages())
                        <li class="page-item">
                            <a class="page-link" href="#" data-page="{{ $products->currentPage() + 1 }}">
                                <i class="fa-solid fa-chevron-right"></i>
                            </a>
                        </li>
                    @else
                        <li class="page-item disabled">
                            <span class="page-link"><i class="fa-solid fa-chevron-right"></i></span>
                        </li>
                    @endif
                </ul>
            </nav>
        </div>
    </div>
@endif

@push('styles')
<style>
/* =========================================================
   EMPTY STATE
   ========================================================= */
.no-products {
    background: #fff;
    border-radius: 16px;
    padding: 60px 24px;
    border: 1px solid #f1f1f1;
}

.no-products .empty-icon {
    width: 90px;
    height: 90px;
    margin: 0 auto 20px;
    border-radius: 50%;
    background: #f8f9fa;
    display: flex;
    align-items: center;
    justify-content: center;
}

.no-products .empty-icon i {
    font-size: 38px;
    color: #c4c9ce;
}

.no-products h3 {
    font-size: 22px;
    font-weight: 700;
    color: #1a1a1a;
    margin-bottom: 8px;
}

.no-products p {
    font-size: 15px;
}

.btn-reset-empty {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    background: #28a745;
    color: #fff;
    border: none;
    padding: 12px 24px;
    border-radius: 10px;
    font-weight: 600;
    font-size: 14px;
    cursor: pointer;
    transition: all 0.2s;
    box-shadow: 0 4px 12px rgba(40, 167, 69, 0.25);
}

.btn-reset-empty:hover {
    background: #218838;
    transform: translateY(-2px);
    box-shadow: 0 6px 16px rgba(40, 167, 69, 0.35);
}

/* =========================================================
   PAGINATION
   ========================================================= */
.products-pagination .pagination {
    gap: 6px;
    flex-wrap: wrap;
    margin: 0;
}

.products-pagination .page-link {
    border-radius: 10px !important;
    min-width: 44px;
    height: 44px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    color: #555;
    border: 1.5px solid #e5e5e5;
    font-weight: 600;
    font-size: 14px;
    padding: 0;
    transition: all 0.2s;
    background: #fff;
}

.products-pagination .page-link:hover {
    background: #e6f4ea;
    color: #28a745;
    border-color: #28a745;
    transform: translateY(-1px);
}

.products-pagination .page-item.active .page-link {
    background: #28a745;
    color: #fff;
    border-color: #28a745;
    box-shadow: 0 4px 12px rgba(40, 167, 69, 0.25);
}

.products-pagination .page-item.disabled .page-link {
    background: #f8f9fa;
    color: #bbb;
    border-color: #f1f1f1;
}

.products-pagination .page-link i {
    font-size: 12px;
}

@media (max-width: 575px) {
    .products-pagination .page-link {
        min-width: 38px;
        height: 38px;
        font-size: 13px;
    }

    .no-products {
        padding: 40px 16px;
    }

    .no-products h3 {
        font-size: 18px;
    }

    .no-products .empty-icon {
        width: 70px;
        height: 70px;
    }

    .no-products .empty-icon i {
        font-size: 28px;
    }
}
</style>
@endpush