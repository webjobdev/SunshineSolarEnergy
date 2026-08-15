@extends('admin.layouts.app')

@section('title', 'Blogs')

@section('content')
<div class="page-heading">
    <div class="page-heading-copy">
        <span class="page-icon"><i class="bi bi-journal-text"></i></span>
        <div>
            <p class="eyebrow mb-1">Content Management</p>
            <h1 class="h3 mb-1">Blogs</h1>
            <p class="text-muted mb-0">Manage all blog posts, categories, tags, and comments.</p>
        </div>
    </div>
    <div class="heading-actions">
        <a class="btn btn-primary btn-sm" href="{{ route('admin.blog.create') }}">
            <i class="bi bi-plus-circle"></i> Add Blog
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
                        <th>Title</th>
                        <th>Category</th>
                        <th>Status</th>
                        <th>Views</th>
                        <th>Published</th>
                        <th width="200">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($blogs as $blog)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                <div class="d-flex align-items-center gap-2">
                                    @if($blog->featured_image)
                                        <img src="{{ $blog->featured_image_url }}" width="50" height="50" class="rounded" alt="{{ $blog->title }}">
                                    @endif
                                    <div>
                                        <strong>{{ $blog->title }}</strong>
                                        <br>
                                        <small class="text-muted">{{ Str::limit($blog->slug, 30) }}</small>
                                    </div>
                                </div>
                            </td>
                            <td>{{ $blog->category->name ?? 'Uncategorized' }}</td>
                            <td>{!! $blog->status_badge !!}</td>
                            <td>{{ number_format($blog->views) }}</td>
                            <td>{{ $blog->published_at ? $blog->published_at->format('M d, Y') : 'Not published' }}</td>
                            <td>
                                <div class="btn-group btn-group-sm">
                                    <a href="{{ route('admin.blog.show', $blog->id) }}" class="btn btn-info" title="View">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.blog.edit', $blog->id) }}" class="btn btn-primary" title="Edit">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <button type="button" class="btn btn-danger delete-blog" 
                                            data-id="{{ $blog->id }}" 
                                            data-title="{{ $blog->title }}"
                                            title="Delete">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-4">
                                <i class="bi bi-journal-text display-4 text-muted d-block mb-3"></i>
                                <h5>No Blogs Found</h5>
                                <p class="text-muted">Start writing your first blog post.</p>
                                <a href="{{ route('admin.blog.create') }}" class="btn btn-primary btn-sm mt-2">
                                    <i class="bi bi-plus-circle"></i> Create Blog
                                </a>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        {{ $blogs->links() }}
    </div>
</div>
@endsection

@push('scripts')

<script>
$(document).ready(function() {
    $('.delete-blog').on('click', function() {
        const blogId = $(this).data('id');
        const blogTitle = $(this).data('title');

        Swal.fire({
            title: 'Are you sure?',
            text: "You want to delete blog: " + blogTitle + "?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '{{ route("admin.blog.delete", ":id") }}'.replace(':id', blogId),
                    type: 'DELETE',
                    data: { _token: '{{ csrf_token() }}' },
                    success: function(response) {
                        if (response.status) {
                            Swal.fire('Deleted!', response.message, 'success').then(() => {
                                location.reload();
                            });
                        }
                    },
                    error: function() {
                        Swal.fire('Error!', 'Something went wrong!', 'error');
                    }
                });
            }
        });
    });
});
</script>
@endpush