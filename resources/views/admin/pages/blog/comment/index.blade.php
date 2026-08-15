@extends('admin.layouts.app')

@section('title', 'Blog Comments')

@section('content')
<div class="page-heading">
    <div class="page-heading-copy">
        <span class="page-icon"><i class="bi bi-chat-dots" aria-hidden="true"></i></span>
        <div>
            <p class="eyebrow mb-1">Content Management</p>
            <h1 class="h3 mb-1">Blog Comments</h1>
            <p class="text-muted mb-0">Manage all blog comments, approve, reject, or delete comments.</p>
        </div>
    </div>
    <div class="heading-actions">
        <div class="btn-group">
            <button class="btn btn-outline-secondary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown">
                <i class="bi bi-funnel" aria-hidden="true"></i> Filter
            </button>
            <ul class="dropdown-menu dropdown-menu-end">
                <li><a class="dropdown-item" href="{{ route('admin.blog.comment') }}">All Comments</a></li>
                <li><a class="dropdown-item" href="{{ route('admin.blog.comment', ['status' => 'pending']) }}">Pending</a></li>
                <li><a class="dropdown-item" href="{{ route('admin.blog.comment', ['status' => 'approved']) }}">Approved</a></li>
                <li><a class="dropdown-item" href="{{ route('admin.blog.comment', ['status' => 'rejected']) }}">Rejected</a></li>
            </ul>
        </div>
    </div>
</div>

<!-- Metrics Cards -->
<section class="row g-3 mt-1" aria-label="Comment summary">
    <div class="col-12 col-sm-6 col-xl-3">
        <article class="metric-card metric-primary">
            <div class="metric-top">
                <span class="metric-label">Total Comments</span>
                <span class="metric-icon"><i class="bi bi-chat-dots" aria-hidden="true"></i></span>
            </div>
            <div class="metric-value">{{ $totalCount ?? 0 }}</div>
            <div class="metric-meta">
                <span class="text-success">+{{ $newCommentsThisMonth ?? 0 }}</span>
                <span>new this month</span>
            </div>
        </article>
    </div>

    <div class="col-12 col-sm-6 col-xl-3">
        <article class="metric-card metric-warning">
            <div class="metric-top">
                <span class="metric-label">Pending</span>
                <span class="metric-icon"><i class="bi bi-clock-history" aria-hidden="true"></i></span>
            </div>
            <div class="metric-value">{{ $pendingCount ?? 0 }}</div>
            <div class="metric-meta">
                <span class="text-warning">Need approval</span>
            </div>
        </article>
    </div>

    <div class="col-12 col-sm-6 col-xl-3">
        <article class="metric-card metric-success">
            <div class="metric-top">
                <span class="metric-label">Approved</span>
                <span class="metric-icon"><i class="bi bi-check-circle" aria-hidden="true"></i></span>
            </div>
            <div class="metric-value">{{ $approvedCount ?? 0 }}</div>
            <div class="metric-meta">
                <span class="text-success">{{ $approvedPercentage ?? 0 }}%</span>
                <span>of total</span>
            </div>
        </article>
    </div>

    <div class="col-12 col-sm-6 col-xl-3">
        <article class="metric-card metric-danger">
            <div class="metric-top">
                <span class="metric-label">Rejected</span>
                <span class="metric-icon"><i class="bi bi-x-circle" aria-hidden="true"></i></span>
            </div>
            <div class="metric-value">{{ $rejectedCount ?? 0 }}</div>
            <div class="metric-meta">
                <span class="text-danger">{{ $rejectedPercentage ?? 0 }}%</span>
                <span>of total</span>
            </div>
        </article>
    </div>
</section>

<!-- Main Panel -->
<section class="panel mt-3">
    <div class="panel-header">
        <div>
            <h2 class="h5 mb-1 section-title">
                <i class="bi bi-table" aria-hidden="true"></i>
                <span>Comment List</span>
            </h2>
            <p class="text-muted mb-0">Search, review, and manage all blog comments.</p>
        </div>
        <div class="d-flex flex-wrap gap-2">
            <input class="form-control form-control-sm table-search" type="search" 
                   placeholder="Search comments..." data-table-search="commentsTable" 
                   aria-label="Search comments" id="searchComments">
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show mx-3 mt-2" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i>
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show mx-3 mt-2" role="alert">
            <i class="bi bi-exclamation-circle-fill me-2"></i>
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="table-responsive">
        <table class="table align-middle mb-0" id="commentsTable" data-searchable-table>
            <thead>
                <tr>
                    <th width="40">
                        <input type="checkbox" id="selectAll" class="form-check-input">
                    </th>
                    <th width="50">#</th>
                    <th>Blog</th>
                    <th>Comment</th>
                    <th>Author</th>
                    <th>Status</th>
                    <th>Date</th>
                    <th width="180" class="text-end">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($comments as $comment)
                    <tr>
                        <td>
                            <input type="checkbox" class="form-check-input comment-checkbox" value="{{ $comment->id }}">
                        </td>
                        <td>{{ $loop->iteration }}</td>
                        <td>
                            <div class="d-flex align-items-center gap-2">
                                <span class="badge bg-primary bg-opacity-10 text-primary p-2">
                                    <i class="bi bi-journal-text"></i>
                                </span>
                                <div>
                                    <p class="fw-semibold mb-0 small">
                                        <a href="{{ route('admin.blog.show', $comment->blog_id) }}" target="_blank">
                                            {{ Str::limit($comment->blog->title ?? 'Unknown Blog', 30) }}
                                        </a>
                                    </p>
                                    <p class="text-muted small mb-0">
                                        <i class="bi bi-hash"></i> ID: {{ $comment->blog_id }}
                                    </p>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="comment-preview">
                                <p class="mb-0 small">{{ Str::limit($comment->comment, 80) }}</p>
                                @if(strlen($comment->comment) > 80)
                                    <button class="btn btn-link btn-sm p-0 text-primary view-full-comment" 
                                            data-comment="{{ e($comment->comment) }}"
                                            title="View full comment">
                                        <small>Read more</small>
                                    </button>
                                @endif
                            </div>
                        </td>
                        <td>
                            <div class="d-flex align-items-center gap-2">
                                @if($comment->user_id)
                                    <img class="avatar-img avatar-sm rounded-circle" 
                                         src="{{ asset('admin-theme/assets/images/avatar/avatar.jpg') }}" 
                                         alt="{{ $comment->user->name ?? 'User' }}">
                                    <div>
                                        <p class="fw-semibold mb-0 small">{{ $comment->user->name ?? 'Unknown' }}</p>
                                        <p class="text-muted small mb-0">{{ $comment->user->email ?? '' }}</p>
                                    </div>
                                @else
                                    <div>
                                        <p class="fw-semibold mb-0 small">{{ $comment->author_name ?? 'Guest' }}</p>
                                        <p class="text-muted small mb-0">{{ $comment->author_email ?? 'No email' }}</p>
                                    </div>
                                @endif
                            </div>
                        </td>
                        <td>
                            {!! $comment->status_badge !!}
                            @if($comment->parent_id)
                                <span class="badge bg-info bg-opacity-10 text-info ms-1">
                                    <i class="bi bi-reply"></i> Reply
                                </span>
                            @endif
                        </td>
                        <td>
                            <div class="text-nowrap">
                                <small class="text-muted">
                                    <i class="bi bi-clock me-1"></i>
                                    {{ $comment->created_at->format('M d, Y') }}
                                </small>
                                <br>
                                <small class="text-muted">
                                    {{ $comment->created_at->format('H:i') }}
                                </small>
                            </div>
                        </td>
                        <td class="text-end">
                            <div class="btn-group btn-group-sm">
                                @if($comment->status == 'pending')
                                    <button type="button" class="btn btn-success approve-comment" 
                                            data-id="{{ $comment->id }}" title="Approve">
                                        <i class="bi bi-check"></i>
                                    </button>
                                    <button type="button" class="btn btn-danger reject-comment" 
                                            data-id="{{ $comment->id }}" title="Reject">
                                        <i class="bi bi-x"></i>
                                    </button>
                                @endif
                                <a href="{{ route('admin.blog.comment.edit', $comment->id) }}" 
                                   class="btn btn-primary" title="Edit">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <button type="button" class="btn btn-danger delete-comment" 
                                        data-id="{{ $comment->id }}" 
                                        data-author="{{ $comment->author_name ?? $comment->user->name ?? 'Guest' }}"
                                        title="Delete">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center py-5">
                            <div class="empty-state">
                                <i class="bi bi-chat-dots display-4 text-muted d-block mb-3"></i>
                                <h5>No Comments Found</h5>
                                <p class="text-muted">No comments have been submitted yet.</p>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="d-flex flex-column flex-sm-row align-items-sm-center justify-content-between gap-3 mt-3">
        <div class="d-flex flex-wrap gap-2">
            <button class="btn btn-sm btn-success" id="bulkApprove">
                <i class="bi bi-check-all me-1"></i> Approve Selected
            </button>
            <button class="btn btn-sm btn-danger" id="bulkReject">
                <i class="bi bi-x-lg me-1"></i> Reject Selected
            </button>
            <button class="btn btn-sm btn-dark" id="bulkDelete">
                <i class="bi bi-trash me-1"></i> Delete Selected
            </button>
        </div>
        <div>
            <p class="text-muted small mb-0">
                Showing {{ $comments->firstItem() ?? 0 }} to {{ $comments->lastItem() ?? 0 }} of {{ $comments->total() }} comments
            </p>
            {{ $comments->links('pagination::bootstrap-4') }}
        </div>
    </div>
</section>
@endsection

@push('styles')
<style>
    .page-heading {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        flex-wrap: wrap;
        gap: 1rem;
        margin-bottom: 1.5rem;
    }
    
    .page-heading-copy {
        display: flex;
        align-items: flex-start;
        gap: 1rem;
    }
    
    .page-icon {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 48px;
        height: 48px;
        background: var(--bs-primary-bg-subtle, #e7f1ff);
        border-radius: 10px;
        color: var(--bs-primary, #0d6efd);
        font-size: 1.5rem;
    }
    
    .eyebrow {
        text-transform: uppercase;
        font-size: 0.75rem;
        font-weight: 600;
        letter-spacing: 0.5px;
        color: var(--bs-secondary-color, #6c757d);
    }
    
    .heading-actions {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        padding-top: 0.5rem;
    }
    
    .metric-card {
        background: #fff;
        border-radius: 0.5rem;
        padding: 1.25rem;
        border-left: 4px solid;
        box-shadow: 0 1px 3px rgba(0,0,0,0.06);
    }
    
    .metric-primary { border-left-color: #0d6efd; }
    .metric-success { border-left-color: #198754; }
    .metric-warning { border-left-color: #ffc107; }
    .metric-danger { border-left-color: #dc3545; }
    
    .metric-top {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 0.5rem;
    }
    
    .metric-label {
        font-size: 0.875rem;
        color: #6c757d;
        font-weight: 500;
    }
    
    .metric-icon {
        font-size: 1.25rem;
        color: #6c757d;
        opacity: 0.7;
    }
    
    .metric-value {
        font-size: 1.75rem;
        font-weight: 700;
        color: #212529;
        line-height: 1.2;
    }
    
    .metric-meta {
        font-size: 0.875rem;
        color: #6c757d;
        margin-top: 0.25rem;
    }
    
    .panel {
        background: #fff;
        border-radius: 0.5rem;
        padding: 1.25rem;
        box-shadow: 0 1px 3px rgba(0,0,0,0.06);
        margin-top: 1.5rem;
    }
    
    .panel-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        flex-wrap: wrap;
        gap: 1rem;
        margin-bottom: 1.25rem;
    }
    
    .section-title {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-weight: 600;
    }
    
    .section-title i {
        color: #0d6efd;
    }
    
    .table-search {
        min-width: 200px;
    }
    
    .table th {
        font-weight: 600;
        color: #495057;
        border-bottom: 2px solid #dee2e6;
    }
    
    .table td {
        vertical-align: middle;
    }
    
    .comment-preview {
        max-width: 250px;
    }
    
    .badge.bg-primary.bg-opacity-10 {
        background-color: rgba(13, 110, 253, 0.1) !important;
    }
    
    .badge.bg-info.bg-opacity-10 {
        background-color: rgba(13, 202, 240, 0.1) !important;
    }
    
    .avatar-sm {
        width: 32px;
        height: 32px;
        object-fit: cover;
    }
    
    .btn-group .btn {
        display: inline-flex;
        align-items: center;
        gap: 0.25rem;
    }
    
    .empty-state i {
        font-size: 3rem;
        color: #dee2e6;
    }
    
    @media (max-width: 768px) {
        .page-heading {
            flex-direction: column;
        }
        
        .heading-actions {
            width: 100%;
        }
        
        .panel-header {
            flex-direction: column;
        }
        
        .table-search {
            min-width: 100%;
        }
        
        .comment-preview {
            max-width: 150px;
        }
        
        .metric-card {
            padding: 1rem;
        }
        
        .metric-value {
            font-size: 1.5rem;
        }
    }
</style>
@endpush

@push('scripts')
<script>
$(document).ready(function() {
    // Select All
    $('#selectAll').on('change', function() {
        $('.comment-checkbox').prop('checked', $(this).prop('checked'));
    });

    // View Full Comment
    $('.view-full-comment').on('click', function() {
        const comment = $(this).data('comment');
        Swal.fire({
            title: 'Full Comment',
            text: comment,
            icon: 'info',
            confirmButtonText: 'Close'
        });
    });

    // Approve Comment
    $('.approve-comment').on('click', function() {
        const commentId = $(this).data('id');
        Swal.fire({
            title: 'Approve Comment?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#28a745',
            cancelButtonColor: '#6c757d',
            confirmButtonText: '<i class="bi bi-check me-2"></i>Yes, approve it!',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    title: 'Processing...',
                    text: 'Please wait',
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });

                $.ajax({
                    url: '{{ route("admin.blog.comment.approve", ":id") }}'.replace(':id', commentId),
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        if (response.status) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Approved!',
                                text: response.message,
                                confirmButtonText: 'OK'
                            }).then(() => {
                                location.reload();
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

    // Reject Comment
    $('.reject-comment').on('click', function() {
        const commentId = $(this).data('id');
        Swal.fire({
            title: 'Reject Comment?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#dc3545',
            cancelButtonColor: '#6c757d',
            confirmButtonText: '<i class="bi bi-x me-2"></i>Yes, reject it!',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    title: 'Processing...',
                    text: 'Please wait',
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });

                $.ajax({
                    url: '{{ route("admin.blog.comment.reject", ":id") }}'.replace(':id', commentId),
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        if (response.status) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Rejected!',
                                text: response.message,
                                confirmButtonText: 'OK'
                            }).then(() => {
                                location.reload();
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

    // Delete Comment
    $('.delete-comment').on('click', function() {
        const commentId = $(this).data('id');
        const author = $(this).data('author');

        Swal.fire({
            title: 'Are you sure?',
            html: "You want to delete comment by: <strong>" + author + "</strong>?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: '<i class="bi bi-trash me-2"></i>Yes, delete it!',
            cancelButtonText: 'Cancel',
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
                    url: '{{ route("admin.blog.comment.delete", ":id") }}'.replace(':id', commentId),
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
                                confirmButtonText: 'OK'
                            }).then(() => {
                                location.reload();
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

    // Bulk Actions
    function getSelectedIds() {
        return $('.comment-checkbox:checked').map(function() {
            return $(this).val();
        }).get();
    }

    function bulkAction(ids, action, title, confirmButtonText) {
        Swal.fire({
            title: title,
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#0d6efd',
            cancelButtonColor: '#6c757d',
            confirmButtonText: confirmButtonText || 'Yes, proceed!',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    title: 'Processing...',
                    text: 'Please wait',
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });

                $.ajax({
                    url: '{{ route("admin.blog.comment.bulk-action") }}',
                    type: 'POST',
                    data: {
                        ids: ids,
                        action: action,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        if (response.status) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Success!',
                                text: response.message,
                                confirmButtonText: 'OK'
                            }).then(() => {
                                location.reload();
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
    }

    $('#bulkApprove').on('click', function() {
        const ids = getSelectedIds();
        if (ids.length === 0) {
            Swal.fire('Warning', 'Please select comments to approve.', 'warning');
            return;
        }
        bulkAction(ids, 'approve', 'Approve selected comments?', '<i class="bi bi-check-all me-2"></i>Yes, approve all!');
    });

    $('#bulkReject').on('click', function() {
        const ids = getSelectedIds();
        if (ids.length === 0) {
            Swal.fire('Warning', 'Please select comments to reject.', 'warning');
            return;
        }
        bulkAction(ids, 'reject', 'Reject selected comments?', '<i class="bi bi-x-lg me-2"></i>Yes, reject all!');
    });

    $('#bulkDelete').on('click', function() {
        const ids = getSelectedIds();
        if (ids.length === 0) {
            Swal.fire('Warning', 'Please select comments to delete.', 'warning');
            return;
        }
        bulkAction(ids, 'delete', 'Delete selected comments?', '<i class="bi bi-trash me-2"></i>Yes, delete all!');
    });

    // Search functionality
    $('#searchComments').on('keyup', function() {
        const searchValue = $(this).val().toLowerCase();
        $('#commentsTable tbody tr').filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(searchValue) > -1);
        });
    });

    // Auto dismiss alerts after 5 seconds
    setTimeout(function() {
        $('.alert').fadeOut('slow');
    }, 5000);
});
</script>
@endpush