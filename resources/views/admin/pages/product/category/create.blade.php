@extends('admin.layouts.app')

@section('title', 'Create Product Category')

@section('content')
<div class="page-heading">
    <div class="page-heading-copy">
        <span class="page-icon"><i class="bi bi-plus-circle"></i></span>
        <div>
            <p class="eyebrow mb-1">Product Management</p>
            <h1 class="h3 mb-1">Create Product Category</h1>
            <p class="text-muted mb-0">Add a new product category.</p>
        </div>
    </div>
    <div class="heading-actions">
        <a class="btn btn-outline-secondary btn-sm" href="{{ route('admin.product.category') }}">
            <i class="bi bi-arrow-left"></i> Back to Categories
        </a>
    </div>
</div>

<section class="row g-3">
    <div class="col-12 col-xl-8">
        <form class="panel" action="{{ route('admin.product.category.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="panel-header">
                <div>
                    <h2 class="h5 mb-1 section-title">
                        <i class="bi bi-tags"></i>
                        <span>Category Information</span>
                    </h2>
                    <p class="text-muted mb-0">Enter category details.</p>
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
                    <label class="form-label">Name <span class="text-danger">*</span></label>
                    <input class="form-control @error('name') is-invalid @enderror"
                           name="name" type="text" value="{{ old('name') }}"
                           placeholder="Enter category name" required>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label class="form-label">Slug <span class="text-danger">*</span></label>
                    <div class="input-group">
                        <input class="form-control @error('slug') is-invalid @enderror"
                               id="slug" name="slug" type="text" value="{{ old('slug') }}"
                               placeholder="Enter slug" required>
                        <button class="btn btn-outline-secondary" type="button" id="generateSlug">
                            <i class="bi bi-magic"></i> Generate
                        </button>
                        @error('slug')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
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
                    <label class="form-label">Image</label>
                    <input class="form-control @error('image') is-invalid @enderror"
                           name="image" type="file" accept="image/*">
                    <small class="text-muted">Recommended size: 400x400 pixels, Max size: 2MB</small>
                    @error('image')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="d-flex flex-wrap justify-content-end gap-2 mt-4">
                <a class="btn btn-outline-secondary" href="{{ route('admin.product.category') }}">Cancel</a>
                <button class="btn btn-primary" type="submit">
                    <i class="bi bi-check-circle"></i> Create Category
                </button>
            </div>
        </form>
    </div>
</section>
@endsection

@push('scripts')
<script>
$(document).ready(function() {
    $('#generateSlug').on('click', function() {
        const name = $('input[name="name"]').val();
        if (!name) {
            Swal.fire('Warning', 'Please enter a name first!', 'warning');
            return;
        }
        $.ajax({
            url: '{{ route("admin.product.category.generate-slug") }}',
            type: 'POST',
            data: { name: name, _token: '{{ csrf_token() }}' },
            success: function(response) {
                if (response.status) { $('#slug').val(response.slug); }
            },
            error: function() { Swal.fire('Error', 'Failed to generate slug!', 'error'); }
        });
    });

    $('input[name="name"]').on('blur', function() {
        if ($('#slug').val() === '') { $('#generateSlug').click(); }
    });

    setTimeout(function() { $('.alert').fadeOut('slow'); }, 5000);
});
</script>
@endpush