@extends('admin.layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="page-heading">
    <div class="page-heading-copy">
        <span class="page-icon"><i class="bi bi-speedometer2" aria-hidden="true"></i></span>
        <div>
            <p class="eyebrow mb-1">Overview</p>
            <h1 class="h3 mb-1">Dashboard</h1>
            <p class="text-muted mb-0">Welcome back, {{ auth()->user()->name }}! Here's what's happening with your website.</p>
        </div>
    </div>
    <div class="heading-actions">
        <span class="badge bg-success">
            <i class="bi bi-check-circle-fill me-1"></i>
            System Running
        </span>
    </div>
</div>

<!-- Website Information Cards -->
<section class="row g-3 mt-1" aria-label="Website summary">
    <!-- Website Status -->
    <div class="col-12 col-sm-6 col-xl-3">
        <article class="metric-card metric-primary">
            <div class="metric-top">
                <span class="metric-label">Website Name</span>
                <span class="metric-icon"><i class="bi bi-globe2" aria-hidden="true"></i></span>
            </div>
            <div class="metric-value" style="font-size: 1.1rem;">
                {{ configSetting('web_name', 'Not Set') }}
            </div>
            <div class="metric-meta">
                <span class="text-muted">{{ configSetting('web_tagline', '') }}</span>
            </div>
        </article>
    </div>

    <!-- Contact Info -->
    <div class="col-12 col-sm-6 col-xl-3">
        <article class="metric-card metric-success">
            <div class="metric-top">
                <span class="metric-label">Contact Email</span>
                <span class="metric-icon"><i class="bi bi-envelope" aria-hidden="true"></i></span>
            </div>
            <div class="metric-value" style="font-size: 1rem;">
                {{ configSetting('contact_email', 'Not Set') }}
            </div>
            <div class="metric-meta">
                <span class="text-success">
                    <i class="bi bi-telephone me-1"></i>
                    {{ configSetting('contact_phone', 'No phone') }}
                </span>
            </div>
        </article>
    </div>

    <!-- Social Media Count -->
    <div class="col-12 col-sm-6 col-xl-3">
        <article class="metric-card metric-info">
            <div class="metric-top">
                <span class="metric-label">Social Media</span>
                <span class="metric-icon"><i class="bi bi-share" aria-hidden="true"></i></span>
            </div>
            <div class="metric-value">{{ $socialCount ?? 0 }}</div>
            <div class="metric-meta">
                <span class="text-info">Active social links</span>
            </div>
        </article>
    </div>

    <!-- System Status -->
    <div class="col-12 col-sm-6 col-xl-3">
        <article class="metric-card metric-warning">
            <div class="metric-top">
                <span class="metric-label">System Status</span>
                <span class="metric-icon"><i class="bi bi-gear" aria-hidden="true"></i></span>
            </div>
            <div class="metric-value" style="font-size: 1rem;">
                @if(configSetting('system_maintenance', false))
                    <span class="text-danger">Maintenance Mode</span>
                @else
                    <span class="text-success">Active</span>
                @endif
            </div>
            <div class="metric-meta">
                <span class="text-muted">
                    @if(configSetting('system_maintenance', false))
                        <i class="bi bi-exclamation-triangle text-danger"></i> Site is down
                    @else
                        <i class="bi bi-check-circle text-success"></i> All systems normal
                    @endif
                </span>
            </div>
        </article>
    </div>
</section>

<!-- Content Stats -->
<section class="row g-3 mt-2">
    <!-- Blog Stats -->
    <div class="col-12 col-md-6 col-xl-3">
        <div class="stat-card">
            <div class="stat-icon bg-primary bg-opacity-10 text-primary">
                <i class="bi bi-journal-text"></i>
            </div>
            <div class="stat-info">
                <h3 class="stat-number">{{ $totalBlogs ?? 0 }}</h3>
                <p class="stat-label">Total Blog Posts</p>
                <small class="text-muted">
                    <span class="text-success">{{ $publishedBlogs ?? 0 }}</span> published, 
                    <span class="text-warning">{{ $draftBlogs ?? 0 }}</span> drafts
                </small>
            </div>
        </div>
    </div>

    <!-- Page Stats -->
    <div class="col-12 col-md-6 col-xl-3">
        <div class="stat-card">
            <div class="stat-icon bg-success bg-opacity-10 text-success">
                <i class="bi bi-file-earmark-text"></i>
            </div>
            <div class="stat-info">
                <h3 class="stat-number">{{ $totalPages ?? 0 }}</h3>
                <p class="stat-label">Total Pages</p>
                <small class="text-muted">
                    <span class="text-success">{{ $activePages ?? 0 }}</span> active, 
                    <span class="text-danger">{{ $inactivePages ?? 0 }}</span> inactive
                </small>
            </div>
        </div>
    </div>

    <!-- Comment Stats -->
    <div class="col-12 col-md-6 col-xl-3">
        <div class="stat-card">
            <div class="stat-icon bg-warning bg-opacity-10 text-warning">
                <i class="bi bi-chat-dots"></i>
            </div>
            <div class="stat-info">
                <h3 class="stat-number">{{ $totalComments ?? 0 }}</h3>
                <p class="stat-label">Total Comments</p>
                <small class="text-muted">
                    <span class="text-success">{{ $approvedComments ?? 0 }}</span> approved,
                    <span class="text-warning">{{ $pendingComments ?? 0 }}</span> pending
                </small>
            </div>
        </div>
    </div>

    <!-- Category/Tags Stats -->
    <div class="col-12 col-md-6 col-xl-3">
        <div class="stat-card">
            <div class="stat-icon bg-info bg-opacity-10 text-info">
                <i class="bi bi-tags"></i>
            </div>
            <div class="stat-info">
                <h3 class="stat-number">{{ $totalCategories ?? 0 }} / {{ $totalTags ?? 0 }}</h3>
                <p class="stat-label">Categories / Tags</p>
                <small class="text-muted">
                    <span class="text-info">{{ $activeCategories ?? 0 }}</span> active categories,
                    <span class="text-primary">{{ $activeTags ?? 0 }}</span> active tags
                </small>
            </div>
        </div>
    </div>
</section>

<!-- Recent Activity & Quick Actions -->
<section class="row g-3 mt-2">
    <!-- Recent Blog Posts -->
    <div class="col-12 col-xl-7">
        <div class="panel">
            <div class="panel-header">
                <div>
                    <h2 class="h5 mb-1 section-title">
                        <i class="bi bi-clock-history"></i>
                        <span>Recent Blog Posts</span>
                    </h2>
                    <p class="text-muted mb-0">Latest blog posts created on your website.</p>
                </div>
                <a href="{{ route('admin.blog') }}" class="btn btn-primary btn-sm">
                    View All <i class="bi bi-arrow-right"></i>
                </a>
            </div>
            <div class="table-responsive">
                <table class="table align-middle mb-0">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Status</th>
                            <th>Date</th>
                            <th class="text-end">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($recentBlogs ?? [] as $blog)
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center gap-2">
                                        @if($blog->featured_image)
                                            <img src="{{ $blog->featured_image_url }}" width="40" height="40" 
                                                 class="rounded" alt="{{ $blog->title }}">
                                        @endif
                                        <div>
                                            <p class="fw-semibold mb-0 small">{{ Str::limit($blog->title, 30) }}</p>
                                            <small class="text-muted">{{ $blog->category->name ?? 'Uncategorized' }}</small>
                                        </div>
                                    </div>
                                </td>
                                <td>{!! $blog->status_badge !!}</td>
                                <td>
                                    <small class="text-muted">
                                        {{ $blog->created_at->format('M d, Y') }}
                                    </small>
                                </td>
                                <td class="text-end">
                                    <a href="{{ route('admin.blog.edit', $blog->id) }}" 
                                       class="btn btn-light btn-sm" title="Edit">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center py-3 text-muted">
                                    No blog posts found. <a href="{{ route('admin.blog.create') }}">Create your first post</a>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Quick Actions & Website Config -->
    <div class="col-12 col-xl-5">
        <!-- Quick Actions -->
        <div class="panel mb-3">
            <div class="panel-header">
                <h2 class="h5 mb-1 section-title">
                    <i class="bi bi-lightning"></i>
                    <span>Quick Actions</span>
                </h2>
            </div>
            <div class="quick-actions-grid">
                <a href="{{ route('admin.blog.create') }}" class="quick-action-item">
                    <i class="bi bi-plus-circle text-primary"></i>
                    <span>New Blog</span>
                </a>
                <a href="{{ route('admin.page.create') }}" class="quick-action-item">
                    <i class="bi bi-file-earmark-plus text-success"></i>
                    <span>New Page</span>
                </a>
                <a href="{{ route('admin.blog.category.create') }}" class="quick-action-item">
                    <i class="bi bi-tag-plus text-warning"></i>
                    <span>New Category</span>
                </a>
                <a href="{{ route('admin.config', ['group' => 'general']) }}" class="quick-action-item">
                    <i class="bi bi-gear text-info"></i>
                    <span>Settings</span>
                </a>
            </div>
        </div>

        <!-- Website Configuration Summary -->
        <div class="panel">
            <div class="panel-header">
                <h2 class="h5 mb-1 section-title">
                    <i class="bi bi-gear-wide-connected"></i>
                    <span>Website Configuration</span>
                </h2>
                <a href="{{ route('admin.config') }}" class="btn btn-outline-secondary btn-sm">
                    Manage <i class="bi bi-arrow-right"></i>
                </a>
            </div>
            <div class="config-summary">
                <div class="config-item">
                    <span class="config-label">Website Name</span>
                    <span class="config-value">{{ configSetting('web_name', 'Not Set') }}</span>
                </div>
                <div class="config-item">
                    <span class="config-label">Logo</span>
                    <span class="config-value">
                        @if(configImage('web_logo'))
                            <i class="bi bi-check-circle text-success"></i> Uploaded
                        @else
                            <span class="text-muted">Not uploaded</span>
                        @endif
                    </span>
                </div>
                <div class="config-item">
                    <span class="config-label">Favicon</span>
                    <span class="config-value">
                        @if(configImage('web_favicon'))
                            <i class="bi bi-check-circle text-success"></i> Uploaded
                        @else
                            <span class="text-muted">Not uploaded</span>
                        @endif
                    </span>
                </div>
                <div class="config-item">
                    <span class="config-label">Contact Email</span>
                    <span class="config-value">{{ configSetting('contact_email', 'Not Set') }}</span>
                </div>
                <div class="config-item">
                    <span class="config-label">Phone</span>
                    <span class="config-value">{{ configSetting('contact_phone', 'Not Set') }}</span>
                </div>
                <div class="config-item">
                    <span class="config-label">Social Links</span>
                    <span class="config-value">{{ $socialCount ?? 0 }} active</span>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Recent Comments -->
<section class="panel mt-3">
    <div class="panel-header">
        <div>
            <h2 class="h5 mb-1 section-title">
                <i class="bi bi-chat-dots"></i>
                <span>Recent Comments</span>
            </h2>
            <p class="text-muted mb-0">Latest comments from visitors on your blog posts.</p>
        </div>
        <a href="{{ route('admin.blog.comment') }}" class="btn btn-primary btn-sm">
            View All <i class="bi bi-arrow-right"></i>
        </a>
    </div>
    <div class="table-responsive">
        <table class="table align-middle mb-0">
            <thead>
                <tr>
                    <th>Author</th>
                    <th>Comment</th>
                    <th>Blog</th>
                    <th>Status</th>
                    <th>Date</th>
                    <th class="text-end">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($recentComments ?? [] as $comment)
                    <tr>
                        <td>
                            <div>
                                <p class="fw-semibold mb-0 small">{{ $comment->author_name ?? $comment->user->name ?? 'Guest' }}</p>
                                <small class="text-muted">{{ $comment->author_email ?? $comment->user->email ?? '' }}</small>
                            </div>
                        </td>
                        <td>{{ Str::limit($comment->comment, 50) }}</td>
                        <td>
                            <small>{{ Str::limit($comment->blog->title ?? 'Unknown', 25) }}</small>
                        </td>
                        <td>{!! $comment->status_badge !!}</td>
                        <td>
                            <small class="text-muted">{{ $comment->created_at->diffForHumans() }}</small>
                        </td>
                        <td class="text-end">
                            @if($comment->status == 'pending')
                                <button class="btn btn-success btn-sm approve-comment" 
                                        data-id="{{ $comment->id }}" title="Approve">
                                    <i class="bi bi-check"></i>
                                </button>
                                <button class="btn btn-danger btn-sm reject-comment" 
                                        data-id="{{ $comment->id }}" title="Reject">
                                    <i class="bi bi-x"></i>
                                </button>
                            @endif
                            <a href="{{ route('admin.blog.comment.edit', $comment->id) }}" 
                               class="btn btn-light btn-sm" title="Edit">
                                <i class="bi bi-pencil"></i>
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center py-3 text-muted">
                            No comments yet.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</section>
@endsection

@push('styles')
<style>
    /* Metric Cards */
    .metric-card {
        background: #fff;
        border-radius: 0.5rem;
        padding: 1.25rem;
        border-left: 4px solid;
        box-shadow: 0 1px 3px rgba(0,0,0,0.06);
        height: 100%;
    }
    
    .metric-primary { border-left-color: #0d6efd; }
    .metric-success { border-left-color: #198754; }
    .metric-warning { border-left-color: #ffc107; }
    .metric-info { border-left-color: #0dcaf0; }
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
        text-transform: uppercase;
        letter-spacing: 0.5px;
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

    /* Stat Cards */
    .stat-card {
        background: #fff;
        border-radius: 0.5rem;
        padding: 1.25rem;
        box-shadow: 0 1px 3px rgba(0,0,0,0.06);
        display: flex;
        align-items: center;
        gap: 1rem;
        height: 100%;
    }
    
    .stat-icon {
        width: 50px;
        height: 50px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        flex-shrink: 0;
    }
    
    .stat-info {
        flex: 1;
    }
    
    .stat-number {
        font-size: 1.5rem;
        font-weight: 700;
        color: #212529;
        margin: 0;
    }
    
    .stat-label {
        font-size: 0.875rem;
        color: #6c757d;
        margin: 0;
    }
    
    .stat-info small {
        font-size: 0.75rem;
    }

    /* Panel */
    .panel {
        background: #fff;
        border-radius: 0.5rem;
        padding: 1.25rem;
        box-shadow: 0 1px 3px rgba(0,0,0,0.06);
    }
    
    .panel-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 1rem;
        margin-bottom: 1rem;
    }
    
    .section-title {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-weight: 600;
        font-size: 1rem;
    }
    
    .section-title i {
        color: #0d6efd;
    }

    /* Quick Actions */
    .quick-actions-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 0.75rem;
    }
    
    .quick-action-item {
        background: #f8f9fa;
        border-radius: 0.5rem;
        padding: 0.75rem;
        text-align: center;
        text-decoration: none;
        color: #212529;
        transition: all 0.3s ease;
        border: 1px solid #e9ecef;
    }
    
    .quick-action-item:hover {
        background: #e9ecef;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0,0,0,0.05);
    }
    
    .quick-action-item i {
        font-size: 1.5rem;
        display: block;
        margin-bottom: 0.25rem;
    }
    
    .quick-action-item span {
        font-size: 0.8rem;
        font-weight: 500;
    }

    /* Config Summary */
    .config-summary {
        display: flex;
        flex-direction: column;
        gap: 0.5rem;
    }
    
    .config-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 0.5rem 0;
        border-bottom: 1px solid #f1f3f5;
    }
    
    .config-item:last-child {
        border-bottom: none;
    }
    
    .config-label {
        font-size: 0.85rem;
        color: #6c757d;
    }
    
    .config-value {
        font-size: 0.85rem;
        font-weight: 500;
        color: #212529;
        text-align: right;
        max-width: 60%;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    /* Page Heading */
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

    @media (max-width: 768px) {
        .quick-actions-grid {
            grid-template-columns: repeat(2, 1fr);
        }
        
        .stat-card {
            padding: 1rem;
        }
        
        .stat-number {
            font-size: 1.25rem;
        }
        
        .metric-value {
            font-size: 1.25rem;
        }
        
        .panel-header {
            flex-direction: column;
            align-items: flex-start;
        }
        
        .page-heading {
            flex-direction: column;
        }
        
        .heading-actions {
            width: 100%;
        }
    }
</style>
@endpush

@push('scripts')
<script>
$(document).ready(function() {
    // Approve Comment
    $('.approve-comment').on('click', function() {
        const commentId = $(this).data('id');
        Swal.fire({
            title: 'Approve Comment?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#28a745',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Yes, approve it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '{{ route("admin.blog.comment.approve", ":id") }}'.replace(':id', commentId),
                    type: 'POST',
                    data: { _token: '{{ csrf_token() }}' },
                    success: function(response) {
                        if (response.status) {
                            Swal.fire('Approved!', response.message, 'success').then(() => {
                                location.reload();
                            });
                        }
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
            confirmButtonText: 'Yes, reject it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '{{ route("admin.blog.comment.reject", ":id") }}'.replace(':id', commentId),
                    type: 'POST',
                    data: { _token: '{{ csrf_token() }}' },
                    success: function(response) {
                        if (response.status) {
                            Swal.fire('Rejected!', response.message, 'success').then(() => {
                                location.reload();
                            });
                        }
                    }
                });
            }
        });
    });
});
</script>
@endpush