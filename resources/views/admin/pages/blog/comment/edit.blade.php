@extends('admin.layouts.app')

@section('title', 'Edit Comment')

@section('content')
<div class="page-heading">
    <div class="page-heading-copy">
        <span class="page-icon"><i class="bi bi-pencil-square" aria-hidden="true"></i></span>
        <div>
            <p class="eyebrow mb-1">Content Management</p>
            <h1 class="h3 mb-1">Edit Comment</h1>
            <p class="text-muted mb-0">Update comment by: <strong>{{ $comment->author_name ?? $comment->user->name ?? 'Guest' }}</strong></p>
        </div>
    </div>
    <div class="heading-actions">
        <a class="btn btn-outline-secondary btn-sm" href="{{ route('admin.blog.comment') }}">
            <i class="bi bi-arrow-left" aria-hidden="true"></i> Back to Comments
        </a>
    </div>
</div>

<section class="row g-3">
    <div class="col-12 col-xl-8">
        <form class="panel" action="{{ route('admin.blog.comment.update', $comment->id) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="panel-header">
                <div>
                    <h2 class="h5 mb-1 section-title">
                        <i class="bi bi-chat-text" aria-hidden="true"></i>
                        <span>Comment Information</span>
                    </h2>
                    <p class="text-muted mb-0">Update comment details and status.</p>
                </div>
                <div>
                    <span class="badge bg-light text-dark">
                        <i class="bi bi-clock me-1"></i>
                        Updated: {{ $comment->updated_at->format('M d, Y H:i') }}
                    </span>
                </div>
            </div>

            @if($errors->any())
                <div class="alert alert-danger alert-dismissible fade show mx-3 mt-2" role="alert">
                    <i class="bi bi-exclamation-circle-fill me-2"></i>
                    <strong>Please fix the following errors:</strong>
                    <ul class="mb-0 mt-1">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="row g-3">
                <!-- Blog Information (Read-only) -->
                <div class="col-12">
                    <div class="bg-light p-3 rounded">
                        <div class="row">
                            <div class="col-md-6">
                                <label class="form-label text-muted small">Blog Post</label>
                                <p class="fw-semibold mb-0">
                                    <a href="{{ route('admin.blog.show', $comment->blog_id) }}" target="_blank">
                                        {{ $comment->blog->title ?? 'Unknown Blog' }}
                                    </a>
                                </p>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label text-muted small">Comment ID</label>
                                <p class="fw-semibold mb-0">#{{ $comment->id }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Author Information (Read-only) -->
                <div class="col-12">
                    <div class="bg-light p-3 rounded">
                        <div class="row">
                            <div class="col-md-4">
                                <label class="form-label text-muted small">Author</label>
                                <p class="fw-semibold mb-0">
                                    {{ $comment->author_name ?? $comment->user->name ?? 'Guest' }}
                                </p>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label text-muted small">Email</label>
                                <p class="mb-0">{{ $comment->author_email ?? $comment->user->email ?? 'N/A' }}</p>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label text-muted small">Website</label>
                                <p class="mb-0">{{ $comment->author_website ?? 'N/A' }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Comment -->
                <div class="col-12">
                    <label class="form-label" for="comment">
                        Comment <span class="text-danger">*</span>
                    </label>
                    <textarea class="form-control @error('comment') is-invalid @enderror" 
                              id="comment" 
                              name="comment" 
                              rows="5" 
                              placeholder="Edit comment content..." 
                              required>{{ old('comment', $comment->comment) }}</textarea>
                    @error('comment')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Status -->
                <div class="col-md-6">
                    <label class="form-label" for="status">
                        Status <span class="text-danger">*</span>
                    </label>
                    <select class="form-select @error('status') is-invalid @enderror" 
                            id="status" 
                            name="status" 
                            required>
                        <option value="pending" {{ old('status', $comment->status) == 'pending' ? 'selected' : '' }}>
                            <i class="bi bi-clock"></i> Pending
                        </option>
                        <option value="approved" {{ old('status', $comment->status) == 'approved' ? 'selected' : '' }}>
                            <i class="bi bi-check-circle"></i> Approved
                        </option>
                        <option value="rejected" {{ old('status', $comment->status) == 'rejected' ? 'selected' : '' }}>
                            <i class="bi bi-x-circle"></i> Rejected
                        </option>
                    </select>
                    <small class="text-muted">Change the comment status</small>
                    @error('status')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Parent Comment (if reply) -->
                @if($comment->parent_id)
                    <div class="col-md-6">
                        <label class="form-label text-muted small">Parent Comment</label>
                        <div class="bg-light p-2 rounded">
                            <p class="mb-0 small">
                                <i class="bi bi-reply text-muted me-1"></i>
                                Reply to: {{ $comment->parent->comment ?? 'Deleted comment' }}
                            </p>
                        </div>
                    </div>
                @endif

                <!-- IP & User Agent (Read-only) -->
                @if($comment->ip_address)
                    <div class="col-12">
                        <div class="bg-light p-2 rounded">
                            <div class="row">
                                <div class="col-md-6">
                                    <label class="form-label text-muted small">IP Address</label>
                                    <p class="mb-0 small">{{ $comment->ip_address ?? 'N/A' }}</p>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label text-muted small">User Agent</label>
                                    <p class="mb-0 small text-truncate">{{ $comment->user_agent ?? 'N/A' }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>

            <div class="d-flex flex-wrap justify-content-end gap-2 mt-4">
                <a class="btn btn-outline-secondary" href="{{ route('admin.blog.comment') }}">
                    <i class="bi bi-x-circle" aria-hidden="true"></i> Cancel
                </a>
                <button class="btn btn-primary" type="submit">
                    <i class="bi bi-check-circle" aria-hidden="true"></i> Update Comment
                </button>
            </div>
        </form>
    </div>

    <!-- Sidebar - Comment Info -->
    <div class="col-12 col-xl-4">
        <div class="panel h-100">
            <h2 class="h5 mb-3 section-title">
                <i class="bi bi-info-circle" aria-hidden="true"></i>
                <span>Comment Information</span>
            </h2>
            <div class="activity-list">
                <div class="activity-item">
                    <span class="activity-dot bg-primary"></span>
                    <div>
                        <p class="mb-1 fw-semibold">Status</p>
                        <p class="text-muted small">{!! $comment->status_badge !!}</p>
                    </div>
                </div>
                <div class="activity-item">
                    <span class="activity-dot {{ $comment->user_id ? 'bg-success' : 'bg-secondary' }}"></span>
                    <div>
                        <p class="mb-1 fw-semibold">User Type</p>
                        <p class="text-muted small">{{ $comment->user_id ? 'Registered User' : 'Guest' }}</p>
                    </div>
                </div>
                <div class="activity-item">
                    <span class="activity-dot {{ $comment->parent_id ? 'bg-info' : 'bg-secondary' }}"></span>
                    <div>
                        <p class="mb-1 fw-semibold">Comment Type</p>
                        <p class="text-muted small">{{ $comment->parent_id ? 'Reply' : 'Main Comment' }}</p>
                    </div>
                </div>
                <div class="activity-item">
                    <span class="activity-dot bg-success"></span>
                    <div>
                        <p class="mb-1 fw-semibold">Created</p>
                        <p class="text-muted small">{{ $comment->created_at->format('M d, Y H:i') }}</p>
                    </div>
                </div>
                <div class="activity-item">
                    <span class="activity-dot bg-warning"></span>
                    <div>
                        <p class="mb-1 fw-semibold">Last Updated</p>
                        <p class="text-muted small">{{ $comment->updated_at->format('M d, Y H:i') }}</p>
                    </div>
                </div>
                <div class="activity-item">
                    <span class="activity-dot bg-secondary"></span>
                    <div>
                        <p class="mb-1 fw-semibold">Created By</p>
                        <p class="text-muted small">{{ $comment->createdBy->name ?? 'System' }}</p>
                    </div>
                </div>
                @if($comment->user_id)
                    <div class="activity-item">
                        <span class="activity-dot bg-info"></span>
                        <div>
                            <p class="mb-1 fw-semibold">User Profile</p>
                            <p class="text-muted small">
                                <a href="#" class="text-decoration-none">
                                    View User <i class="bi bi-arrow-right"></i>
                                </a>
                            </p>
                        </div>
                    </div>
                @endif
            </div>
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
    
    .heading-actions .btn {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }
    
    .panel {
        background: #fff;
        border-radius: 0.5rem;
        padding: 1.25rem;
        box-shadow: 0 1px 3px rgba(0,0,0,0.06);
    }
    
    .panel-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        flex-wrap: wrap;
        gap: 1rem;
        margin-bottom: 1.25rem;
        padding-bottom: 0.75rem;
        border-bottom: 1px solid #e9ecef;
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
    
    .activity-list {
        display: flex;
        flex-direction: column;
        gap: 1rem;
    }
    
    .activity-item {
        display: flex;
        align-items: flex-start;
        gap: 0.75rem;
    }
    
    .activity-dot {
        display: inline-block;
        width: 10px;
        height: 10px;
        border-radius: 50%;
        margin-top: 4px;
        flex-shrink: 0;
    }
    
    .activity-dot.bg-success { background-color: #198754; }
    .activity-dot.bg-primary { background-color: #0d6efd; }
    .activity-dot.bg-warning { background-color: #ffc107; }
    .activity-dot.bg-info { background-color: #0dcaf0; }
    .activity-dot.bg-secondary { background-color: #6c757d; }
    
    .form-label {
        font-weight: 500;
        font-size: 0.875rem;
    }
    
    .text-danger {
        color: #dc3545 !important;
    }
    
    .bg-light {
        background-color: #f8f9fa !important;
    }
    
    .panel-header .badge {
        font-size: 0.75rem;
        padding: 0.5rem 0.75rem;
    }
    
    @media (max-width: 768px) {
        .page-heading {
            flex-direction: column;
        }
        
        .heading-actions {
            width: 100%;
        }
        
        .heading-actions .btn {
            flex: 1;
        }
        
        .panel-header {
            flex-direction: column;
        }
        
        .panel-header .badge {
            display: inline-block;
            margin-bottom: 0.25rem;
        }
    }
</style>
@endpush

@push('scripts')
<script>
$(document).ready(function() {
    // Form validation
    (function() {
        'use strict';
        const forms = document.querySelectorAll('.panel form');
        Array.from(forms).forEach(function(form) {
            form.addEventListener('submit', function(event) {
                if (!form.checkValidity()) {
                    event.preventDefault();
                    event.stopPropagation();
                }
                form.classList.add('was-validated');
            }, false);
        });
    })();
});
</script>
@endpush