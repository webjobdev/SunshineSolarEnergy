<!-- Products Page Start -->
<div class="page-products">
    <div class="container">

        {{-- Mobile filter bar --}}
        <div class="mobile-filter-bar d-lg-none mb-3">
            <button type="button" class="btn-filter-mobile" id="openMobileFilter">
                <i class="fa-solid fa-sliders"></i>
                <span>Filters</span>
                <span class="filter-badge" id="mobileFilterCount"></span>
            </button>
            <div class="mobile-sort-wrap">
                <select id="sortMobile" class="form-select">
                    <option value="newest"     {{ request('sort') == 'newest'     ? 'selected' : '' }}>Newest</option>
                    <option value="price_low"  {{ request('sort') == 'price_low'  ? 'selected' : '' }}>Price ↑</option>
                    <option value="price_high" {{ request('sort') == 'price_high' ? 'selected' : '' }}>Price ↓</option>
                    <option value="popular"    {{ request('sort') == 'popular'    ? 'selected' : '' }}>Popular</option>
                </select>
            </div>
        </div>

        <div class="row g-4">
            {{-- Sidebar (desktop) --}}
            <div class="col-lg-3 d-none d-lg-block">
                @include('frontend.sections.products-sidebar')
            </div>

            {{-- Products column --}}
            <div class="col-lg-9 col-12">

                {{-- Header --}}
                <div class="products-header">
                    <div class="row g-2 align-items-center">
                        <div class="col-12 col-md-6">
                            <p class="products-count mb-0" id="productsCount">
                                Showing <strong>{{ $products->firstItem() ?? 0 }}-{{ $products->lastItem() ?? 0 }}</strong>
                                of <strong>{{ $products->total() ?? 0 }}</strong> products
                            </p>
                        </div>
                        <div class="col-12 col-md-6 d-none d-lg-block">
                            <div class="products-sort">
                                <label for="sort">Sort by:</label>
                                <select id="sort" class="form-select">
                                    <option value="newest"     {{ request('sort') == 'newest'     ? 'selected' : '' }}>Newest</option>
                                    <option value="price_low"  {{ request('sort') == 'price_low'  ? 'selected' : '' }}>Price: Low to High</option>
                                    <option value="price_high" {{ request('sort') == 'price_high' ? 'selected' : '' }}>Price: High to Low</option>
                                    <option value="popular"    {{ request('sort') == 'popular'    ? 'selected' : '' }}>Popular</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- AJAX Container --}}
                <div id="productsAjaxContainer" class="products-ajax-wrap">
                    @include('frontend.sections.products-grid', ['products' => $products])
                </div>

                {{-- Loading overlay --}}
                <div class="products-loading-overlay" id="productsLoading" style="display:none;">
                    <div class="loading-spinner"></div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Mobile Filter Drawer --}}
<div class="mobile-filter-drawer" id="mobileFilterDrawer">
    <div class="mobile-filter-overlay" id="mobileFilterOverlay"></div>
    <div class="mobile-filter-panel">
        <div class="mobile-filter-header">
            <h5>Filters</h5>
            <button type="button" class="btn-close-drawer" id="closeMobileFilter" aria-label="Close">
                <i class="fa-solid fa-xmark"></i>
            </button>
        </div>
        <div class="mobile-filter-body" id="mobileFilterBody"></div>
        <div class="mobile-filter-footer">
            <button type="button" class="btn-reset-drawer" id="resetMobileFilter">
                <i class="fa-solid fa-rotate-right"></i> Reset
            </button>
            <button type="button" class="btn-apply-drawer" id="applyMobileFilter">
                <i class="fa-solid fa-check"></i> Apply
            </button>
        </div>
    </div>
</div>
<!-- Products Page End -->

@push('styles')
<style>
.page-products {
    padding: 30px 0 60px;
    background: #fafbfc;
}

/* -------- Mobile filter bar -------- */
.mobile-filter-bar {
    display: flex;
    gap: 10px;
    align-items: center;
    background: #fff;
    padding: 10px 12px;
    border-radius: 12px;
    border: 1px solid #f1f1f1;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.04);
}

.btn-filter-mobile {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    background: #28a745;
    color: #fff;
    border: none;
    padding: 10px 18px;
    border-radius: 10px;
    font-size: 14px;
    font-weight: 600;
    cursor: pointer;
    transition: background 0.2s;
    flex-shrink: 0;
}

.btn-filter-mobile:hover { background: #218838; }

.btn-filter-mobile .filter-badge {
    background: #fff;
    color: #28a745;
    font-size: 11px;
    font-weight: 700;
    padding: 2px 8px;
    border-radius: 10px;
    min-width: 22px;
    text-align: center;
}

.btn-filter-mobile .filter-badge:empty { display: none; }

.mobile-sort-wrap { flex: 1; }
.mobile-sort-wrap .form-select {
    height: 42px;
    font-size: 14px;
    border-radius: 10px;
    border: 1.5px solid #e5e5e5;
}

/* -------- Products header -------- */
.products-header {
    background: #fff;
    padding: 16px 20px;
    border-radius: 14px;
    margin-bottom: 18px;
    border: 1px solid #f1f1f1;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.04);
}

.products-count {
    font-size: 14px;
    color: #666;
}

.products-count strong { color: #1a1a1a; }

.products-sort {
    display: flex;
    align-items: center;
    gap: 12px;
    justify-content: flex-end;
}

.products-sort label {
    font-size: 14px;
    color: #666;
    white-space: nowrap;
    margin: 0;
    font-weight: 500;
}

.products-sort .form-select {
    height: 42px;
    border-radius: 10px;
    border: 1.5px solid #e5e5e5;
    font-size: 14px;
    max-width: 220px;
    min-width: 150px;
    transition: border-color 0.2s, box-shadow 0.2s;
}

.products-sort .form-select:focus {
    border-color: #28a745;
    box-shadow: 0 0 0 4px rgba(40, 167, 69, 0.1);
    outline: none;
}

/* -------- AJAX container -------- */
.products-ajax-wrap {
    position: relative;
    min-height: 300px;
    transition: opacity 0.25s;
}

.products-ajax-wrap.is-loading {
    opacity: 0.4;
    pointer-events: none;
}

.products-loading-overlay {
    position: fixed;
    top: 100px;
    left: 50%;
    transform: translateX(-50%);
    z-index: 999;
}

.loading-spinner {
    width: 48px;
    height: 48px;
    border: 4px solid #e6f4ea;
    border-top-color: #28a745;
    border-radius: 50%;
    animation: spin 0.7s linear infinite;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    background: #fff;
}

@keyframes spin {
    to { transform: rotate(360deg); }
}

/* -------- Mobile drawer -------- */
.mobile-filter-drawer {
    position: fixed;
    inset: 0;
    z-index: 1060;
    visibility: hidden;
    opacity: 0;
    transition: opacity 0.3s, visibility 0.3s;
}

.mobile-filter-drawer.is-open {
    visibility: visible;
    opacity: 1;
}

.mobile-filter-overlay {
    position: absolute;
    inset: 0;
    background: rgba(0, 0, 0, 0.5);
    backdrop-filter: blur(3px);
}

.mobile-filter-panel {
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    max-height: 88vh;
    background: #fff;
    border-radius: 24px 24px 0 0;
    display: flex;
    flex-direction: column;
    transform: translateY(100%);
    transition: transform 0.35s cubic-bezier(0.4, 0, 0.2, 1);
    overflow: hidden;
}

.mobile-filter-drawer.is-open .mobile-filter-panel {
    transform: translateY(0);
}

.mobile-filter-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 18px 22px;
    border-bottom: 1px solid #f0f0f0;
    flex-shrink: 0;
}

.mobile-filter-header h5 {
    font-size: 18px;
    font-weight: 700;
    margin: 0;
    color: #1a1a1a;
}

.btn-close-drawer {
    width: 36px;
    height: 36px;
    border-radius: 50%;
    background: #f1f3f5;
    border: none;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #555;
    font-size: 16px;
    transition: all 0.2s;
}

.btn-close-drawer:hover {
    background: #e2e6ea;
    color: #111;
}

.mobile-filter-body {
    flex: 1;
    overflow-y: auto;
    padding: 18px 22px;
}

.mobile-filter-body .sidebar-widget {
    background: #fff;
    padding: 0;
    margin-bottom: 22px;
    border-radius: 0;
    box-shadow: none;
    border: none;
    border-bottom: 1px solid #f0f0f0;
    padding-bottom: 20px;
}

.mobile-filter-body .sidebar-widget:last-child {
    border-bottom: none;
    margin-bottom: 0;
    padding-bottom: 0;
}

.mobile-filter-body .filter-list {
    max-height: none;
    overflow: visible;
}

.mobile-filter-body .filter-actions {
    display: none;
}

.mobile-filter-footer {
    display: flex;
    gap: 10px;
    padding: 16px 22px;
    border-top: 1px solid #f0f0f0;
    background: #fff;
    flex-shrink: 0;
    padding-bottom: calc(16px + env(safe-area-inset-bottom));
}

.btn-reset-drawer,
.btn-apply-drawer {
    flex: 1;
    height: 48px;
    border-radius: 12px;
    font-weight: 700;
    font-size: 15px;
    border: none;
    cursor: pointer;
    transition: all 0.2s;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
}

.btn-reset-drawer {
    background: #f1f3f5;
    color: #333;
}

.btn-reset-drawer:hover { background: #e2e6ea; }

.btn-apply-drawer {
    background: #28a745;
    color: #fff;
    box-shadow: 0 4px 12px rgba(40, 167, 69, 0.25);
}

.btn-apply-drawer:hover {
    background: #218838;
    box-shadow: 0 6px 16px rgba(40, 167, 69, 0.35);
}

/* -------- Responsive -------- */
@media (max-width: 991px) {
    .page-products { padding: 20px 0 40px; }
}

@media (max-width: 575px) {
    .page-products { padding: 15px 0 30px; }
    .products-header { padding: 14px 16px; }
    .products-count { font-size: 13px; }
}
</style>
@endpush

@push('scripts')
<script>
/**
 * Products AJAX Filter — no page reload
 */
window.ProductsFilter = (function () {
    const container      = () => document.getElementById('productsAjaxContainer');
    const loading        = () => document.getElementById('productsLoading');
    const countEl        = () => document.getElementById('productsCount');
    const filterForm     = () => document.getElementById('productsFilterForm');
    const filterEndpoint = '{{ route('products.filter') }}';

    let debounceTimer  = null;
    let currentRequest = null;

    /** Build the query string from URL + form */
    function buildQuery(page) {
        const params = new URLSearchParams(window.location.search);

        if (page) {
            params.set('page', page);
        } else {
            params.delete('page');
        }

        const form = filterForm();
        if (form) {
            const formData = new FormData(form);

            ['search', 'categories[]', 'brands[]'].forEach(key => params.delete(key));

            for (const [key, value] of formData.entries()) {
                if (value !== '' && key !== 'sort') {
                    params.append(key, value);
                }
            }
        }

        return params;
    }

    /** Fetch products via AJAX */
    function fetchProducts(page) {
        const params = buildQuery(page);

        if (currentRequest) currentRequest.abort();

        const containerEl = container();
        containerEl.classList.add('is-loading');
        if (loading()) loading().style.display = 'block';

        currentRequest = $.ajax({
            url: filterEndpoint + '?' + params.toString(),
            type: 'GET',
            dataType: 'json',
            success: function (response) {
                if (response.status) {
                    containerEl.innerHTML = response.html;

                    if (countEl()) {
                        countEl().innerHTML =
                            `Showing <strong>${response.first_item}-${response.last_item}</strong> ` +
                            `of <strong>${response.total}</strong> products`;
                    }

                    const newUrl = window.location.pathname + '?' + params.toString();
                    window.history.pushState({}, '', newUrl);

                    updateMobileFilterCount();

                    if (typeof WOW !== 'undefined') new WOW().init();

                    const header = document.querySelector('.products-header');
                    if (header) {
                        const top = header.getBoundingClientRect().top + window.pageYOffset - 100;
                        window.scrollTo({ top: top, behavior: 'smooth' });
                    }
                }
            },
            error: function (xhr, status) {
                if (status !== 'abort') console.error('Products fetch failed', xhr);
            },
            complete: function () {
                containerEl.classList.remove('is-loading');
                if (loading()) loading().style.display = 'none';
            }
        });
    }

    /** Count active filters for mobile badge */
    function updateMobileFilterCount() {
        const badge = document.getElementById('mobileFilterCount');
        if (!badge) return;

        const form = filterForm();
        if (!form) return;

        let count = 0;
        form.querySelectorAll('input[type="checkbox"]:checked').forEach(() => count++);
        form.querySelectorAll('input[type="text"]').forEach(input => {
            if (input.value.trim() !== '') count++;
        });

        badge.textContent = count > 0 ? count : '';
    }

    /** Reset all filters */
    function reset() {
        window.location.href = '{{ route('products') }}';
    }

    /** Init events */
    function init() {
        // Desktop sort
        const sort = document.getElementById('sort');
        if (sort) {
            sort.addEventListener('change', function () {
                const desktopSort = document.getElementById('sortMobile');
                if (desktopSort) desktopSort.value = this.value;
                fetchProducts(null);
            });
        }

        // Mobile sort
        const sortMobile = document.getElementById('sortMobile');
        if (sortMobile) {
            sortMobile.addEventListener('change', function () {
                const desktopSort = document.getElementById('sort');
                if (desktopSort) desktopSort.value = this.value;
                fetchProducts(null);
            });
        }

        // Checkbox change → debounced AJAX
        document.addEventListener('change', function (e) {
            const form = filterForm();
            if (!form || !form.contains(e.target)) return;

            if (e.target.matches('input[type="checkbox"]')) {
                clearTimeout(debounceTimer);
                debounceTimer = setTimeout(() => fetchProducts(null), 200);
            }
        });

        // Search input — debounced 500ms
        document.addEventListener('input', function (e) {
            if (e.target.matches('input[name="search"]')) {
                clearTimeout(debounceTimer);
                debounceTimer = setTimeout(() => fetchProducts(null), 500);
            }
        });

        // Search button click
        document.addEventListener('click', function (e) {
            if (e.target.closest('.search-btn')) {
                e.preventDefault();
                fetchProducts(null);
            }
        });

        // Pagination clicks
        document.addEventListener('click', function (e) {
            const link = e.target.closest('#productsAjaxContainer .page-link[data-page]');
            if (!link) return;
            e.preventDefault();
            fetchProducts(link.dataset.page);
        });

        // Browser back/forward
        window.addEventListener('popstate', function () {
            const params = new URLSearchParams(window.location.search);
            fetchProducts(params.get('page'));
        });

        // ==========================
        // Mobile drawer
        // ==========================
        const drawer    = document.getElementById('mobileFilterDrawer');
        const overlay   = document.getElementById('mobileFilterOverlay');
        const openBtn   = document.getElementById('openMobileFilter');
        const closeBtn  = document.getElementById('closeMobileFilter');
        const applyBtn  = document.getElementById('applyMobileFilter');
        const resetBtn  = document.getElementById('resetMobileFilter');
        const mobileBody = document.getElementById('mobileFilterBody');

        function openDrawer() {
            const desktopSidebar = document.querySelector('.products-sidebar');
            if (desktopSidebar && mobileBody) {
                mobileBody.innerHTML = desktopSidebar.innerHTML;
            }
            drawer.classList.add('is-open');
            document.body.style.overflow = 'hidden';
        }

        function closeDrawer() {
            drawer.classList.remove('is-open');
            document.body.style.overflow = '';
        }

        if (openBtn) openBtn.addEventListener('click', openDrawer);
        if (closeBtn) closeBtn.addEventListener('click', closeDrawer);
        if (overlay) overlay.addEventListener('click', closeDrawer);

        if (applyBtn) {
            applyBtn.addEventListener('click', function () {
                const desktopForm = filterForm();
                const mobileForm = mobileBody.querySelector('form');

                if (desktopForm && mobileForm) {
                    desktopForm.querySelectorAll('input[type="checkbox"]').forEach(cb => cb.checked = false);

                    mobileForm.querySelectorAll('input[type="checkbox"]:checked').forEach(cb => {
                        const target = desktopForm.querySelector(`input[name="${cb.name}"][value="${cb.value}"]`);
                        if (target) target.checked = true;
                    });

                    const mobileSearch = mobileForm.querySelector('input[name="search"]');
                    const desktopSearch = desktopForm.querySelector('input[name="search"]');
                    if (desktopSearch && mobileSearch) desktopSearch.value = mobileSearch.value;
                }

                closeDrawer();
                fetchProducts(null);
            });
        }

        if (resetBtn) {
            resetBtn.addEventListener('click', function () {
                const mobileForm = mobileBody.querySelector('form');
                if (mobileForm) mobileForm.reset();
                closeDrawer();
                reset();
            });
        }

        updateMobileFilterCount();
    }

    return { init, fetchProducts, reset };
})();

$(document).ready(function () {
    window.ProductsFilter.init();
});
</script>
@endpush