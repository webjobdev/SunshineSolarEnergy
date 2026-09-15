@extends('admin.layouts.app')

@section('title', 'Products')

@section('content')
<div class="page-heading">
    <div class="page-heading-copy">
        <span class="page-icon"><i class="bi bi-box-seam"></i></span>
        <div>
            <p class="eyebrow mb-1">Product Management</p>
            <h1 class="h3 mb-1">Products</h1>
            <p class="text-muted mb-0">Manage all products, brands, categories, and galleries.</p>
        </div>
    </div>
    <div class="heading-actions">
        <a class="btn btn-primary btn-sm" href="{{ route('admin.product.create') }}">
            <i class="bi bi-plus-circle"></i> Add Product
        </a>
    </div>
</div>

<div class="panel mt-3">
    <div class="panel-header">
        <div>
            <h2 class="h5 mb-1 section-title">
                <i class="bi bi-table"></i>
                <span>Product List</span>
            </h2>
            <p class="text-muted mb-0">Search, review, and manage all products.</p>
        </div>
        <div class="d-flex flex-wrap gap-2">
            <input class="form-control form-control-sm table-search" type="search"
                   placeholder="Search products..." id="searchProducts">
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show mx-3 mt-2">
            <i class="bi bi-check-circle-fill me-2"></i>
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show mx-3 mt-2">
            <i class="bi bi-exclamation-circle-fill me-2"></i>
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="table-responsive">
        <table class="table align-middle mb-0" id="productsTable">
            <thead>
                <tr>
                    <th width="50">#</th>
                    <th>Thumbnail</th>
                    <th>Name</th>
                    <th>Brand</th>
                    <th>Category</th>
                    <th>Price</th>
                    <th>Flags</th>
                    <th>Status</th>
                    <th class="text-end">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($products as $product)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>
                            @if($product->thumbnail)
                                <img src="{{ $product->thumbnail_url }}" width="50" height="50" class="rounded" alt="{{ $product->name }}">
                            @else
                                <span class="text-muted">No image</span>
                            @endif
                        </td>
                        <td>
                            <p class="fw-semibold mb-0">{{ $product->name }}</p>
                            <p class="text-muted small mb-0">
                                <i class="bi bi-link-45deg me-1"></i>
                                {{ Str::limit($product->slug, 30) }}
                            </p>
                        </td>
                        <td>{{ $product->brand->name ?? 'N/A' }}</td>
                        <td>{{ $product->category->name ?? 'N/A' }}</td>
                        <td>
                            @if($product->price)
                                <span class="fw-semibold">{{ number_format($product->price, 2) }}</span>
                            @else
                                <span class="text-muted">N/A</span>
                            @endif
                        </td>
                        <td>
                            @if($product->new == 'active')
                                <span class="badge bg-info-subtle text-info">New</span>
                            @endif
                            @if($product->trending == 'active')
                                <span class="badge bg-warning-subtle text-warning">Trending</span>
                            @endif
                            @if($product->show_on_home_page == 'active')
                                <span class="badge bg-success-subtle text-success">Home</span>
                            @endif
                        </td>
                        <td>{!! $product->status_badge !!}</td>
                        <td class="text-end">
                            <div class="d-flex justify-content-end gap-1">
                                <a href="{{ route('admin.product.edit', $product->id) }}"
                                   class="btn btn-light btn-sm" title="Edit">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <button type="button"
                                        class="btn btn-light btn-sm delete-product"
                                        data-id="{{ $product->id }}"
                                        data-name="{{ $product->name }}"
                                        title="Delete">
                                    <i class="bi bi-trash text-danger"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="9" class="text-center py-5">
                            <div class="empty-state">
                                <i class="bi bi-box-seam display-4 text-muted d-block mb-3"></i>
                                <h5>No Products Found</h5>
                                <p class="text-muted">Start creating your first product.</p>
                                <a href="{{ route('admin.product.create') }}" class="btn btn-primary btn-sm mt-2">
                                    <i class="bi bi-plus-circle"></i> Create Product
                                </a>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="d-flex flex-column flex-sm-row align-items-sm-center justify-content-between gap-3 mt-3">
        <p class="text-muted small mb-0">
            Showing {{ $products->firstItem() ?? 0 }} to {{ $products->lastItem() ?? 0 }} of {{ $products->total() }} products
        </p>
        <nav aria-label="Products pagination">
            {{ $products->links('pagination::bootstrap-4') }}
        </nav>
    </div>
</div>
@endsection

@push('scripts')
<script>
$(document).ready(function() {
    $('.delete-product').on('click', function() {
        const productId = $(this).data('id');
        const productName = $(this).data('name');

        Swal.fire({
            title: 'Are you sure?',
            html: "You want to delete product: <strong>" + productName + "</strong>?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: '<i class="bi bi-trash me-2"></i>Yes, delete it!',
            cancelButtonText: '<i class="bi bi-x-circle me-2"></i>Cancel',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    title: 'Deleting...',
                    text: 'Please wait',
                    allowOutsideClick: false,
                    didOpen: () => { Swal.showLoading(); }
                });

                $.ajax({
                    url: '{{ route("admin.product.delete", ":id") }}'.replace(':id', productId),
                    type: 'DELETE',
                    data: { _token: '{{ csrf_token() }}' },
                    success: function(response) {
                        if (response.status) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Deleted!',
                                text: response.message,
                                confirmButtonText: '<i class="bi bi-check-circle me-2"></i>OK'
                            }).then(() => { location.reload(); });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error!',
                                text: response.message || 'Something went wrong!'
                            });
                        }
                    },
                    error: function(xhr) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: xhr.responseJSON?.message || 'Something went wrong!'
                        });
                    }
                });
            }
        });
    });

    $('#searchProducts').on('keyup', function() {
        const searchValue = $(this).val().toLowerCase();
        $('#productsTable tbody tr').filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(searchValue) > -1);
        });
    });

    setTimeout(function() { $('.alert').fadeOut('slow'); }, 5000);
});
</script>
@endpush