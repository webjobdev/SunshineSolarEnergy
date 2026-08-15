@extends('admin.layouts.app')

@section('title', 'Blog Categories')

@section('content')
<div class="page-heading">
    <div class="page-heading-copy">
        <span class="page-icon"><i class="bi bi-tags"></i></span>
        <div>
            <p class="eyebrow mb-1">Content Management</p>
            <h1 class="h3 mb-1">Blog Categories</h1>
            <p class="text-muted mb-0">Manage blog categories for organizing content.</p>
        </div>
    </div>
    <div class="heading-actions">
        <a class="btn btn-primary btn-sm" href="{{ route('admin.blog.category.create') }}">
            <i class="bi bi-plus-circle"></i> Add Category
        </a>
    </div>
</div>

<div class="card">
    <div class="card-body">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Slug</th>
                        <th>Description</th>
                        <th>Blogs</th>
                        <th>Status</th>
                        <th width="150">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($categories as $category)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td><strong>{{ $category->name }}</strong></td>
                            <td><span class="badge bg-light text-dark">{{ $category->slug }}</span></td>
                            <td>{{ Str::limit($category->description, 50) }}</td>
                            <td><span class="badge bg-primary">{{ $category->blogs_count }}</span></td>
                            <td>{!! $category->status_badge !!}</td>
                            <td>
                                <div class="btn-group btn-group-sm">
                                    <a href="{{ route('admin.blog.category.edit', $category->id) }}" class="btn btn-primary">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <button type="button" class="btn btn-danger delete-category" 
                                            data-id="{{ $category->id }}" 
                                            data-name="{{ $category->name }}">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-4">
                                <i class="bi bi-tags display-4 text-muted d-block mb-3"></i>
                                <h5>No Categories Found</h5>
                                <p class="text-muted">Create your first blog category.</p>
                                <a href="{{ route('admin.blog.category.create') }}" class="btn btn-primary btn-sm mt-2">
                                    <i class="bi bi-plus-circle"></i> Create Category
                                </a>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        {{ $categories->links() }}
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
            text: "Delete category: " + categoryName + "?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '{{ route("admin.blog.category.delete", ":id") }}'.replace(':id', categoryId),
                    type: 'DELETE',
                    data: { _token: '{{ csrf_token() }}' },
                    success: function(response) {
                        if (response.status) {
                            Swal.fire('Deleted!', response.message, 'success').then(() => {
                                location.reload();
                            });
                        } else {
                            Swal.fire('Error!', response.message, 'error');
                        }
                    },
                    error: function(xhr) {
                        Swal.fire('Error!', xhr.responseJSON?.message || 'Something went wrong!', 'error');
                    }
                });
            }
        });
    });
});
</script>
@endpush