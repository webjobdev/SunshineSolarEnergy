@extends('admin.layouts.app')

@section('title', 'Create Customer Review')

@section('content')
<div class="page-heading">
    <div class="page-heading-copy">
        <span class="page-icon"><i class="bi bi-plus-circle"></i></span>
        <div>
            <p class="eyebrow mb-1">Content Management</p>
            <h1 class="h3 mb-1">Create Customer Review</h1>
            <p class="text-muted mb-0">Add a new customer review.</p>
        </div>
    </div>
    <div class="heading-actions">
        <a class="btn btn-outline-secondary btn-sm" href="{{ route('admin.customer-review') }}">
            <i class="bi bi-arrow-left"></i> Back to Reviews
        </a>
    </div>
</div>

<section class="row g-3">
    <div class="col-12 col-xl-8">
        <form class="panel" action="{{ route('admin.customer-review.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="panel-header">
                <div>
                    <h2 class="h5 mb-1 section-title">
                        <i class="bi bi-star"></i>
                        <span>Review Information</span>
                    </h2>
                    <p class="text-muted mb-0">Enter customer review details.</p>
                </div>
            </div>

            @if($errors->any())
                <div class="alert alert-danger alert-dismissible fade show mx-3 mt-2">
                    <strong>Please fix the following errors:</strong>
                    <ul class="mb-0 mt-1">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">Customer Name <span class="text-danger">*</span></label>
                    <input class="form-control @error('name') is-invalid @enderror"
                           name="name" type="text" value="{{ old('name') }}"
                           placeholder="Enter customer name" required>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label class="form-label">Sort Order</label>
                    <input class="form-control @error('sort_order') is-invalid @enderror"
                           name="sort_order" type="number" value="{{ old('sort_order', 0) }}"
                           placeholder="Enter sort order" min="0">
                    @error('sort_order')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label class="form-label">Status <span class="text-danger">*</span></label>
                    <select class="form-select @error('status') is-invalid @enderror" name="status" required>
                        <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active</option>
                        <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                    </select>
                    @error('status')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-12">
                    <label class="form-label">Customer Image</label>
                    <input class="form-control @error('image') is-invalid @enderror"
                           name="image" type="file" accept="image/*">
                    <small class="text-muted">Recommended size: 200x200 pixels, Max size: 2MB</small>
                    @error('image')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-12">
                    <label class="form-label">Review Description</label>
                    <textarea class="form-control @error('description') is-invalid @enderror"
                              name="description" rows="5"
                              placeholder="Enter customer review text">{{ old('description') }}</textarea>
                    <small class="text-muted">Maximum 1000 characters</small>
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="d-flex flex-wrap justify-content-end gap-2 mt-4">
                <a class="btn btn-outline-secondary" href="{{ route('admin.customer-review') }}">Cancel</a>
                <button class="btn btn-primary" type="submit">
                    <i class="bi bi-check-circle"></i> Create Review
                </button>
            </div>
        </form>
    </div>

    <!-- Sidebar -->
    <div class="col-12 col-xl-4">
        <div class="panel h-100">
            <h2 class="h5 mb-3 section-title">
                <i class="bi bi-list-check"></i>
                <span>Review Checklist</span>
            </h2>
            <div class="activity-list">
                <div class="activity-item">
                    <span class="activity-dot bg-success"></span>
                    <div>
                        <p class="mb-1 fw-semibold">Customer Name</p>
                        <p class="text-muted small">Enter the customer name.</p>
                    </div>
                </div>
                <div class="activity-item">
                    <span class="activity-dot bg-primary"></span>
                    <div>
                        <p class="mb-1 fw-semibold">Customer Image</p>
                        <p class="text-muted small">Add a customer photo.</p>
                    </div>
                </div>
                <div class="activity-item">
                    <span class="activity-dot bg-warning"></span>
                    <div>
                        <p class="mb-1 fw-semibold">Review Text</p>
                        <p class="text-muted small">Write the customer review.</p>
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
    setTimeout(function() { $('.alert').fadeOut('slow'); }, 5000);
});
</script>
@endpush