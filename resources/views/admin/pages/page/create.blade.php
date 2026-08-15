@extends('admin.layouts.app')

@section('title', 'Create Page')

@section('content')
    <!-- Page Heading -->
    <div class="page-heading">
        <div class="page-heading-copy">
            <span class="page-icon"><i class="bi bi-file-earmark-plus" aria-hidden="true"></i></span>
            <div>
                <p class="eyebrow mb-1">Content Management</p>
                <h1 class="h3 mb-1">Create Page</h1>
                <p class="text-muted mb-0">Create a new webpage with SEO metadata, focus keywords, and robots directives for better search engine visibility.</p>
            </div>
        </div>
        <div class="heading-actions">
            <a class="btn btn-outline-secondary btn-sm" href="{{ route('admin.page') }}">
                <i class="bi bi-arrow-left" aria-hidden="true"></i> Back to Pages
            </a>
        </div>
    </div>

    <!-- Form Section -->
    <section class="row g-3">
        <div class="col-12 col-xl-8">
            <form class="panel needs-validation" action="{{ route('admin.page.store') }}" method="POST" novalidate>
                @csrf
                
                <div class="panel-header">
                    <div>
                        <h2 class="h5 mb-1 section-title">
                            <i class="bi bi-file-earmark-text" aria-hidden="true"></i>
                            <span>Page Information</span>
                        </h2>
                        <p class="text-muted mb-0">Enter the page details and SEO metadata.</p>
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
                    <!-- Page Name -->
                    <div class="col-md-6">
                        <label class="form-label" for="page_name">
                            Page Name <span class="text-danger">*</span>
                        </label>
                        <input class="form-control @error('page_name') is-invalid @enderror" 
                               id="page_name" name="page_name" type="text" 
                               value="{{ old('page_name') }}" 
                               placeholder="Enter page name" required>
                        @error('page_name')
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
                                   id="slug" name="slug" type="text" 
                                   value="{{ old('slug') }}" 
                                   placeholder="Enter slug" required>
                            <button class="btn btn-outline-secondary" type="button" id="generateSlug">
                                <i class="bi bi-magic"></i> Generate
                            </button>
                            @error('slug')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Meta Title -->
                    <div class="col-md-6">
                        <label class="form-label" for="meta_title">
                            Meta Title
                        </label>
                        <input class="form-control @error('meta_title') is-invalid @enderror" 
                               id="meta_title" name="meta_title" type="text" 
                               value="{{ old('meta_title') }}" 
                               placeholder="Enter meta title (60-70 characters recommended)">
                        <small class="text-muted">Recommended length: 60-70 characters</small>
                        @error('meta_title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Focus Keyword -->
                    <div class="col-md-6">
                        <label class="form-label" for="focus_keyword">
                            Focus Keyword
                        </label>
                        <input class="form-control @error('focus_keyword') is-invalid @enderror" 
                               id="focus_keyword" name="focus_keyword" type="text" 
                               value="{{ old('focus_keyword') }}" 
                               placeholder="Enter primary focus keyword">
                        <small class="text-muted">Primary keyword for SEO optimization</small>
                        @error('focus_keyword')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Canonical URL -->
                    <div class="col-md-6">
                        <label class="form-label" for="canonical_url">
                            Canonical URL
                        </label>
                        <input class="form-control @error('canonical_url') is-invalid @enderror" 
                               id="canonical_url" name="canonical_url" type="text" 
                               value="{{ old('canonical_url') }}" 
                               placeholder="Enter canonical URL">
                        <small class="text-muted">The canonical URL for this page</small>
                        @error('canonical_url')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Robots -->
                    <div class="col-md-6">
                        <label class="form-label" for="robots">
                            Robots <span class="text-danger">*</span>
                        </label>
                        <select class="form-select @error('robots') is-invalid @enderror" 
                                id="robots" name="robots" required>
                            <option value="">Choose robots directive</option>
                            @foreach($robotsOptions as $value => $label)
                                <option value="{{ $value }}" {{ old('robots') == $value ? 'selected' : '' }}>
                                    {{ $label }}
                                </option>
                            @endforeach
                        </select>
                        @error('robots')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Status -->
                    <div class="col-md-6">
                        <label class="form-label" for="status">
                            Status <span class="text-danger">*</span>
                        </label>
                        <select class="form-select @error('status') is-invalid @enderror" 
                                id="status" name="status" required>
                            <option value="">Select status</option>
                            <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active</option>
                            <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                        </select>
                        <small class="text-muted">Active pages will be visible on the frontend</small>
                        @error('status')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Meta Description -->
                    <div class="col-12">
                        <label class="form-label" for="meta_description">
                            Meta Description
                        </label>
                        <textarea class="form-control @error('meta_description') is-invalid @enderror" 
                                  id="meta_description" name="meta_description" rows="3" 
                                  placeholder="Enter meta description (150-160 characters recommended)">{{ old('meta_description') }}</textarea>
                        <small class="text-muted">Recommended length: 150-160 characters</small>
                        @error('meta_description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Meta Keywords -->
                    <div class="col-12">
                        <label class="form-label" for="meta_keywords">
                            Meta Keywords
                        </label>
                        <textarea class="form-control @error('meta_keywords') is-invalid @enderror" 
                                  id="meta_keywords" name="meta_keywords" rows="2" 
                                  placeholder="Enter meta keywords separated by commas">{{ old('meta_keywords') }}</textarea>
                        <small class="text-muted">Separate keywords with commas (e.g., web, design, development)</small>
                        @error('meta_keywords')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="d-flex flex-wrap justify-content-end gap-2 mt-4">
                    <a class="btn btn-outline-secondary" href="{{ route('admin.page') }}">
                        <i class="bi bi-x-circle" aria-hidden="true"></i> Cancel
                    </a>
                    <button class="btn btn-primary" type="submit">
                        <i class="bi bi-check-circle" aria-hidden="true"></i> Create Page
                    </button>
                </div>
            </form>
        </div>

        <!-- Sidebar - SEO Checklist -->
        <div class="col-12 col-xl-4">
            <div class="panel h-100">
                <h2 class="h5 mb-3 section-title">
                    <i class="bi bi-list-check" aria-hidden="true"></i>
                    <span>SEO Checklist</span>
                </h2>
                <div class="activity-list">
                    <div class="activity-item">
                        <span class="activity-dot bg-success"></span>
                        <div>
                            <p class="mb-1 fw-semibold">Page Name & Slug</p>
                            <p class="text-muted small mb-0">Enter a descriptive page name and SEO-friendly slug.</p>
                        </div>
                    </div>
                    <div class="activity-item">
                        <span class="activity-dot bg-primary"></span>
                        <div>
                            <p class="mb-1 fw-semibold">Meta Title & Description</p>
                            <p class="text-muted small mb-0">Optimize meta tags for better search engine ranking.</p>
                        </div>
                    </div>
                    <div class="activity-item">
                        <span class="activity-dot bg-warning"></span>
                        <div>
                            <p class="mb-1 fw-semibold">Focus Keyword</p>
                            <p class="text-muted small mb-0">Define primary keyword to focus content around.</p>
                        </div>
                    </div>
                    <div class="activity-item">
                        <span class="activity-dot bg-info"></span>
                        <div>
                            <p class="mb-1 fw-semibold">Robots Directive</p>
                            <p class="text-muted small mb-0">Control how search engines crawl and index the page.</p>
                        </div>
                    </div>
                    <div class="activity-item">
                        <span class="activity-dot bg-secondary"></span>
                        <div>
                            <p class="mb-1 fw-semibold">Canonical URL</p>
                            <p class="text-muted small mb-0">Prevent duplicate content issues with canonical tags.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('scripts')
<script>
    $(document).ready(function() {
        // Generate slug
        $('#generateSlug').on('click', function() {
            const pageName = $('#page_name').val();
            
            if (!pageName) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Warning',
                    text: 'Please enter a page name first!'
                });
                return;
            }

            $.ajax({
                url: '{{ route("admin.page.generate.slug") }}',
                type: 'POST',
                data: {
                    page_name: pageName,
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

        // Auto generate slug when page name changes (optional)
        $('#page_name').on('blur', function() {
            if ($('#slug').val() === '') {
                $('#generateSlug').click();
            }
        });

        // Form validation
        (function() {
            'use strict';
            const forms = document.querySelectorAll('.needs-validation');
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