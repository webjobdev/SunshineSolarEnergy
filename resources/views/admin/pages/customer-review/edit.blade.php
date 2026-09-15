@extends('admin.layouts.app')

@section('title', 'Edit Customer Review')

@section('content')
<div class="page-heading">
    <div class="page-heading-copy">
        <span class="page-icon"><i class="bi bi-pencil-square"></i></span>
        <div>
            <p class="eyebrow mb-1">Content Management</p>
            <h1 class="h3 mb-1">Edit Customer Review</h1>
            <p class="text-muted mb-0">Update review from: <strong>{{ $review->name }}</strong></p>
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
        <form class="panel" action="{{ route('admin.customer-review.update', $review->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="panel-header">
                <div>
                    <h2 class="h5 mb-1 section-title">
                        <i class="bi bi-star"></i>
                        <span>Review Information</span>
                    </h2>
                    <p class="text-muted mb-0">Update customer review details.</p>
                </div>
                <div>
                    <span class="badge bg-light text-dark">
                        <i class="bi bi-clock me-1"></i>
                        Updated: {{ $review->updated_at->format('M d, Y H:i') }}
                    </span>
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
                           name="name" type="text" value="{{ old('name', $review->name) }}" required>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label class="form-label">Sort Order</label>
                    <input class="form-control @error('sort_order') is-invalid @enderror"
                           name="sort_order" type="number" value="{{ old('sort_order', $review->sort_order) }}" min="0">
                    @error('sort_order')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label class="form-label">Status <span class="text-danger">*</span></label>
                    <select class="form-select @error('status') is-invalid @enderror" name="status" required>
                        <option value="active" {{ old('status', $review->status) == 'active' ? 'selected' : '' }}>Active</option>
                        <option value="inactive" {{ old('status', $review->status) == 'inactive' ? 'selected' : '' }}>Inactive</option>
                    </select>
                    @error('status')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-12">
                    <label class="form-label">Customer Image</label>
                    @if($review->image)
                        <div class="mb-2 p-2 bg-light rounded">
                            <img src="{{ $review->image_url }}" width="100" height="100" class="rounded-circle object-fit-cover" alt="{{ $review->name }}">
                        </div>
                    @endif
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
                              name="description" rows="5">{{ old('description', $review->description) }}</textarea>
                    <small class="text-muted">Maximum 1000 characters</small>
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="d-flex flex-wrap justify-content-end gap-2 mt-4">
                <a class="btn btn-outline-secondary" href="{{ route('admin.customer-review') }}">Cancel</a>
                <button class="btn btn-primary" type="submit">
                    <i class="bi bi-check-circle"></i> Update Review
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
                    <span class="activity-dot {{ $review->name ? 'bg-success' : 'bg-secondary' }}"></span>
                    <div>
                        <p class="mb-1 fw-semibold">Customer Name</p>
                        <p class="text-muted small">{{ $review->name ? 'Name is set' : 'Name is missing' }}</p>
                    </div>
                </div>
                <div class="activity-item">
                    <span class="activity-dot {{ $review->image ? 'bg-success' : 'bg-warning' }}"></span>
                    <div>
                        <p class="mb-1 fw-semibold">Customer Image</p>
                        <p class="text-muted small">{{ $review->image ? 'Image is set' : 'Image is missing' }}</p>
                    </div>
                </div>
                <div class="activity-item">
                    <span class="activity-dot {{ $review->description ? 'bg-success' : 'bg-warning' }}"></span>
                    <div>
                        <p class="mb-1 fw-semibold">Review Text</p>
                        <p class="text-muted small">{{ $review->description ? 'Review is set' : 'Review is missing' }}</p>
                    </div>
                </div>
                <div class="activity-item">
                    <span class="activity-dot {{ $review->status == 'active' ? 'bg-success' : 'bg-warning' }}"></span>
                    <div>
                        <p class="mb-1 fw-semibold">Status</p>
                        <p class="text-muted small">Review is {{ $review->status }} on frontend</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('styles')
<style>
    .object-fit-cover { object-fit: cover; }
    .bg-light { background-color: #f8f9fa !important; }
</style>
@endpush

@push('scripts')
<script>
$(document).ready(function() {
    setTimeout(function() { $('.alert').fadeOut('slow'); }, 5000);
});
</script>
@endpush