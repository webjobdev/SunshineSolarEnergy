@extends('admin.layouts.app')

@section('title', 'Blog Tags')

@section('content')
<div class="page-heading">
    <div class="page-heading-copy">
        <span class="page-icon"><i class="bi bi-tags" aria-hidden="true"></i></span>
        <div>
            <p class="eyebrow mb-1">Content Management</p>
            <h1 class="h3 mb-1">Blog Tags</h1>
            <p class="text-muted mb-0">Manage blog tags for content categorization and filtering.</p>
        </div>
    </div>
    <div class="heading-actions">
        <a class="btn btn-primary btn-sm" href="{{ route('admin.blog.tag.create') }}">
            <i class="bi bi-plus-circle" aria-hidden="true"></i> Add Tag
        </a>
    </div>
</div>

<div class="card">
    <div class="card-body">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="bi bi-check-circle-fill me-2"></i>
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="bi bi-exclamation-circle-fill me-2"></i>
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="table-responsive">
            <table class="table table-bordered table-hover align-middle">
                <thead>
                    <tr>
                        <th width="50">#</th>
                        <th>Tag Name</th>
                        <th>Slug</th>
                        <th>Blogs</th>
                        <th>Status</th>
                        <th>Created</th>
                        <th width="150">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($tags as $tag)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                <div class="d-flex align-items-center gap-2">
                                    <span class="badge bg-primary bg-opacity-10 text-primary p-2">
                                        <i class="bi bi-tag"></i>
                                    </span>
                                    <strong>{{ $tag->name }}</strong>
                                </div>
                            </td>
                            <td>
                                <span class="badge bg-light text-dark">
                                    <i class="bi bi-link-45deg me-1"></i>
                                    {{ $tag->slug }}
                                </span>
                            </td>
                            <td>
                                <span class="badge bg-info">
                                    <i class="bi bi-journal-text me-1"></i>
                                    {{ $tag->blogs_count }}
                                </span>
                            </td>
                            <td>{!! $tag->status_badge !!}</td>
                            <td>
                                <small class="text-muted">
                                    <i class="bi bi-clock me-1"></i>
                                    {{ $tag->created_at->format('M d, Y') }}
                                </small>
                            </td>
                            <td>
                                <div class="btn-group btn-group-sm">
                                    <a href="{{ route('admin.blog.tag.edit', $tag->id) }}" 
                                       class="btn btn-primary" 
                                       title="Edit Tag">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <button type="button" 
                                            class="btn btn-danger delete-tag" 
                                            data-id="{{ $tag->id }}" 
                                            data-name="{{ $tag->name }}"
                                            title="Delete Tag">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-5">
                                <div class="empty-state">
                                    <i class="bi bi-tags display-4 text-muted d-block mb-3"></i>
                                    <h5>No Tags Found</h5>
                                    <p class="text-muted">Create your first blog tag to categorize content.</p>
                                    <a href="{{ route('admin.blog.tag.create') }}" class="btn btn-primary btn-sm mt-2">
                                        <i class="bi bi-plus-circle" aria-hidden="true"></i> Create Tag
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
                Showing {{ $tags->firstItem() ?? 0 }} to {{ $tags->lastItem() ?? 0 }} of {{ $tags->total() }} tags
            </p>
            <nav aria-label="Tags pagination">
                {{ $tags->links('pagination::bootstrap-4') }}
            </nav>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .empty-state i {
        font-size: 3rem;
        color: #dee2e6;
    }
    
    .btn-group .btn {
        display: inline-flex;
        align-items: center;
        gap: 0.25rem;
    }
    
    .badge.bg-primary.bg-opacity-10 {
        background-color: rgba(13, 110, 253, 0.1) !important;
    }
</style>
@endpush

@push('scripts')

<script>
$(document).ready(function() {
    // Delete Tag with SweetAlert
    $('.delete-tag').on('click', function() {
        const tagId = $(this).data('id');
        const tagName = $(this).data('name');

        Swal.fire({
            title: 'Are you sure?',
            html: "You want to delete tag: <strong>" + tagName + "</strong>?",
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
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });

                $.ajax({
                    url: '{{ route("admin.blog.tag.delete", ":id") }}'.replace(':id', tagId),
                    type: 'DELETE',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        if (response.status) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Deleted!',
                                text: response.message,
                                confirmButtonText: '<i class="bi bi-check-circle me-2"></i>OK'
                            }).then(() => {
                                location.reload();
                            });
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

    // Auto dismiss alerts after 5 seconds
    setTimeout(function() {
        $('.alert').fadeOut('slow');
    }, 5000);
});
</script>
@endpush