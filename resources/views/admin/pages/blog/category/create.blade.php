@extends('admin.layouts.app')

@section('title', 'Create Category')

@section('content')
<div class="page-heading">
    <div class="page-heading-copy">
        <span class="page-icon"><i class="bi bi-tag-plus"></i></span>
        <div>
            <p class="eyebrow mb-1">Content Management</p>
            <h1 class="h3 mb-1">Create Category</h1>
            <p class="text-muted mb-0">Create a new blog category.</p>
        </div>
    </div>
    <div class="heading-actions">
        <a class="btn btn-outline-secondary btn-sm" href="{{ route('admin.blog.category') }}">
            <i class="bi bi-arrow-left"></i> Back to Categories
        </a>
    </div>
</div>

<div class="card">
    <div class="card-body">
        @if($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.blog.category.store') }}" method="POST">
            @csrf
            
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Name <span class="text-danger">*</span></label>
                    <input class="form-control @error('name') is-invalid @enderror" 
                           name="name" type="text" value="{{ old('name') }}" required>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Slug <span class="text-danger">*</span></label>
                    <div class="input-group">
                        <input class="form-control @error('slug') is-invalid @enderror" 
                               id="slug" name="slug" type="text" value="{{ old('slug') }}" required>
                        <button class="btn btn-outline-secondary" type="button" id="generateSlug">
                            <i class="bi bi-magic"></i> Generate
                        </button>
                        @error('slug')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-12 mb-3">
                    <label class="form-label">Description</label>
                    <textarea class="form-control @error('description') is-invalid @enderror" 
                              name="description" rows="3">{{ old('description') }}</textarea>
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Status <span class="text-danger">*</span></label>
                    <select class="form-select @error('status') is-invalid @enderror" name="status" required>
                        <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active</option>
                        <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                    </select>
                    @error('status')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="mt-3">
                <button class="btn btn-primary" type="submit">
                    <i class="bi bi-check-circle"></i> Create Category
                </button>
                <a class="btn btn-outline-secondary" href="{{ route('admin.blog.category') }}">Cancel</a>
            </div>
        </form>
    </div>
</div>
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
            url: '{{ route("admin.blog.category.generate-slug") }}',
            type: 'POST',
            data: { name: name, _token: '{{ csrf_token() }}' },
            success: function(response) {
                if (response.status) {
                    $('#slug').val(response.slug);
                }
            }
        });
    });
});
</script>
@endpush