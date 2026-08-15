@extends('admin.layouts.app')

@section('title', 'Edit Tag')

@section('content')
<div class="page-heading">
    <div class="page-heading-copy">
        <span class="page-icon"><i class="bi bi-tag" aria-hidden="true"></i></span>
        <div>
            <p class="eyebrow mb-1">Content Management</p>
            <h1 class="h3 mb-1">Edit Tag</h1>
            <p class="text-muted mb-0">Update tag details: <strong>{{ $tag->name }}</strong></p>
        </div>
    </div>
    <div class="heading-actions">
        <a class="btn btn-outline-secondary btn-sm" href="{{ route('admin.blog.tag') }}">
            <i class="bi bi-arrow-left" aria-hidden="true"></i> Back to Tags
        </a>
    </div>
</div>

<section class="row g-3">
    <div class="col-12 col-xl-8">
        <form class="panel" action="{{ route('admin.blog.tag.update', $tag->id) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="panel-header">
                <div>
                    <h2 class="h5 mb-1 section-title">
                        <i class="bi bi-tag" aria-hidden="true"></i>
                        <span>Tag Information</span>
                    </h2>
                    <p class="text-muted mb-0">Update tag details and SEO-friendly slug.</p>
                </div>
                <div>
                    <span class="badge bg-light text-dark">
                        <i class="bi bi-clock me-1"></i>
                        Updated: {{ $tag->updated_at->format('M d, Y H:i') }}
                    </span>
                    <span class="badge bg-light text-dark ms-1">
                        <i class="bi bi-journal-text me-1"></i>
                        {{ $tag->blogs_count ?? 0 }} blogs
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
                <!-- Tag Name -->
                <div class="col-md-6">
                    <label class="form-label" for="name">
                        Tag Name <span class="text-danger">*</span>
                    </label>
                    <input class="form-control @error('name') is-invalid @enderror" 
                           id="name" 
                           name="name" 
                           type="text" 
                           value="{{ old('name', $tag->name) }}" 
                           placeholder="Enter tag name (e.g., Laravel)" 
                           required>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Slug -->
                <div class="col-md-6">
                    <label class="form-label" for="slug">
                        Slug <span class="text-danger">*</span>
                    </label>
                    <div class="input-group">
                        <input class="form-control @error('slug') is-invalid @enderror" 
                               id="slug" 
                               name="slug" 
                               type="text" 
                               value="{{ old('slug', $tag->slug) }}" 
                               placeholder="Enter slug (e.g., laravel)" 
                               required>
                        <button class="btn btn-outline-secondary" type="button" id="generateSlug">
                            <i class="bi bi-magic"></i> Generate
                        </button>
                        @error('slug')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <small class="text-muted">URL-friendly version of the tag name</small>
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
                        <option value="active" {{ old('status', $tag->status) == 'active' ? 'selected' : '' }}>Active</option>
                        <option value="inactive" {{ old('status', $tag->status) == 'inactive' ? 'selected' : '' }}>Inactive</option>
                    </select>
                    <small class="text-muted">Active tags will be available for blog posts</small>
                    @error('status')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="d-flex flex-wrap justify-content-end gap-2 mt-4">
                <a class="btn btn-outline-secondary" href="{{ route('admin.blog.tag') }}">
                    <i class="bi bi-x-circle" aria-hidden="true"></i> Cancel
                </a>
                <button class="btn btn-primary" type="submit">
                    <i class="bi bi-check-circle" aria-hidden="true"></i> Update Tag
                </button>
            </div>
        </form>
    </div>

    <!-- Sidebar - Tag Info -->
    <div class="col-12 col-xl-4">
        <div class="panel h-100">
            <h2 class="h5 mb-3 section-title">
                <i class="bi bi-info-circle" aria-hidden="true"></i>
                <span>Tag Information</span>
            </h2>
            <div class="activity-list">
                <div class="activity-item">
                    <span class="activity-dot {{ $tag->name ? 'bg-success' : 'bg-secondary' }}"></span>
                    <div>
                        <p class="mb-1 fw-semibold">Tag Name</p>
                        <p class="text-muted small">{{ $tag->name ?: 'Not set' }}</p>
                    </div>
                </div>
                <div class="activity-item">
                    <span class="activity-dot {{ $tag->slug ? 'bg-success' : 'bg-secondary' }}"></span>
                    <div>
                        <p class="mb-1 fw-semibold">Slug</p>
                        <p class="text-muted small">{{ $tag->slug ?: 'Not set' }}</p>
                    </div>
                </div>
                <div class="activity-item">
                    <span class="activity-dot {{ $tag->status == 'active' ? 'bg-success' : 'bg-warning' }}"></span>
                    <div>
                        <p class="mb-1 fw-semibold">Status</p>
                        <p class="text-muted small">Tag is {{ $tag->status }}</p>
                    </div>
                </div>
                <div class="activity-item">
                    <span class="activity-dot {{ $tag->blogs_count > 0 ? 'bg-success' : 'bg-secondary' }}"></span>
                    <div>
                        <p class="mb-1 fw-semibold">Blogs Using This Tag</p>
                        <p class="text-muted small">{{ $tag->blogs_count ?? 0 }} blog(s)</p>
                    </div>
                </div>
                <div class="activity-item">
                    <span class="activity-dot bg-info"></span>
                    <div>
                        <p class="mb-1 fw-semibold">Created</p>
                        <p class="text-muted small">{{ $tag->created_at->format('M d, Y H:i') }}</p>
                    </div>
                </div>
                <div class="activity-item">
                    <span class="activity-dot bg-secondary"></span>
                    <div>
                        <p class="mb-1 fw-semibold">Created By</p>
                        <p class="text-muted small">{{ $tag->createdBy->name ?? 'System' }}</p>
                    </div>
                </div>
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
    // Generate slug
    $('#generateSlug').on('click', function() {
        const name = $('#name').val();
        
        if (!name) {
            Swal.fire({
                icon: 'warning',
                title: 'Warning',
                text: 'Please enter a tag name first!'
            });
            return;
        }

        $.ajax({
            url: '{{ route("admin.blog.tag.generate-slug") }}',
            type: 'POST',
            data: {
                name: name,
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                if (response.status) {
                    $('#slug').val(response.slug);
                }
            },
            error: function() {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Failed to generate slug!'
                });
            }
        });
    });

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