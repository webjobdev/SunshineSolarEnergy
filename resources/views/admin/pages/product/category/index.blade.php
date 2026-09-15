@extends('admin.layouts.app')

@section('title', 'Product Categories')

@section('content')
<div class="page-heading">
    <div class="page-heading-copy">
        <span class="page-icon"><i class="bi bi-tags"></i></span>
        <div>
            <p class="eyebrow mb-1">Product Management</p>
            <h1 class="h3 mb-1">Product Categories</h1>
            <p class="text-muted mb-0">Manage all product categories.</p>
        </div>
    </div>
    <div class="heading-actions">
        <a class="btn btn-primary btn-sm" href="{{ route('admin.product.category.create') }}">
            <i class="bi bi-plus-circle"></i> Add Category
        </a>
    </div>
</div>

<div class="panel mt-3">
    <div class="panel-header">
        <div>
            <h2 class="h5 mb-1 section-title">
                <i class="bi bi-table"></i>
                <span>Category List</span>
            </h2>
            <p class="text-muted mb-0">Search, review, and manage all product categories.</p>
        </div>
        <div class="d-flex flex-wrap gap-2">
            <input class="form-control form-control-sm table-search" type="search"
                   placeholder="Search categories..." id="searchCategories">
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
        <table class="table align-middle mb-0" id="categoriesTable">
            <thead>
                <tr>
                    <th width="50">#</th>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Slug</th>
                    <th>Products</th>
                    <th>Sort Order</th>
                    <th>Status</th>
                    <th class="text-end">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($categories as $category)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>
                            @if($category->image)
                                <img src="{{ $category->image_url }}" width="50" height="50" class="rounded" alt="{{ $category->name }}">
                            @else
                                <span class="text-muted">No image</span>
                            @endif
                        </td>
                        <td>
                            <p class="fw-semibold mb-0">{{ $category->name }}</p>
                        </td>
                        <td>
                            <span class="badge bg-light text-dark">
                                <i class="bi bi-link-45deg me-1"></i>
                                {{ $category->slug }}
                            </span>
                        </td>
                        <td>{{ $category->products_count }}</td>
                        <td>{{ $category->sort_order }}</td>
                        <td>{!! $category->status_badge !!}</td>
                        <td class="text-end">
                            <div class="d-flex justify-content-end gap-1">
                                <a href="{{ route('admin.product.category.edit', $category->id) }}"
                                   class="btn btn-light btn-sm" title="Edit">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <button type="button"
                                        class="btn btn-light btn-sm delete-category"
                                        data-id="{{ $category->id }}"
                                        data-name="{{ $category->name }}"
                                        title="Delete">
                                    <i class="bi bi-trash text-danger"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center py-5">
                            <div class="empty-state">
                                <i class="bi bi-tags display-4 text-muted d-block mb-3"></i>
                                <h5>No Categories Found</h5>
                                <p class="text-muted">Start creating your first product category.</p>
                                <a href="{{ route('admin.product.category.create') }}" class="btn btn-primary btn-sm mt-2">
                                    <i class="bi bi-plus-circle"></i> Create Category
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
            Showing {{ $categories->firstItem() ?? 0 }} to {{ $categories->lastItem() ?? 0 }} of {{ $categories->total() }} categories
        </p>
        <nav aria-label="Categories pagination">
            {{ $categories->links('pagination::bootstrap-4') }}
        </nav>
    </div>
</div>
@endsection

@push('scripts')
<script>
$(document).ready(function() {
    $('.delete-category').on('click', function() {
        const categoryId = $(this).data('id');
        const categoryName = $(this).data('name');

        Swal.fire({
            title: 'Are you sure?',
            html: "You want to delete category: <strong>" + categoryName + "</strong>?",
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
                    url: '{{ route("admin.product.category.delete", ":id") }}'.replace(':id', categoryId),
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

    $('#searchCategories').on('keyup', function() {
        const searchValue = $(this).val().toLowerCase();
        $('#categoriesTable tbody tr').filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(searchValue) > -1);
        });
    });

    setTimeout(function() { $('.alert').fadeOut('slow'); }, 5000);
});
</script>
@endpush