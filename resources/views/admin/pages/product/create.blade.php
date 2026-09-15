@extends('admin.layouts.app')

@section('title', 'Create Product')

@section('content')
<div class="page-heading">
    <div class="page-heading-copy">
        <span class="page-icon"><i class="bi bi-plus-circle"></i></span>
        <div>
            <p class="eyebrow mb-1">Product Management</p>
            <h1 class="h3 mb-1">Create Product</h1>
            <p class="text-muted mb-0">Add a new product with details, images, and SEO settings.</p>
        </div>
    </div>
    <div class="heading-actions">
        <a class="btn btn-outline-secondary btn-sm" href="{{ route('admin.product') }}">
            <i class="bi bi-arrow-left"></i> Back to Products
        </a>
    </div>
</div>

<section class="row g-3">
    <div class="col-12 col-xl-8">
        <form class="panel" action="{{ route('admin.product.store') }}" method="POST" enctype="multipart/form-data" id="productForm">
            @csrf

            <div class="panel-header">
                <div>
                    <h2 class="h5 mb-1 section-title">
                        <i class="bi bi-box-seam"></i>
                        <span>Product Information</span>
                    </h2>
                    <p class="text-muted mb-0">Enter product details.</p>
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
                           placeholder="Enter product name" required>
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
                    <label class="form-label">Brand</label>
                    <select class="form-select @error('brand_id') is-invalid @enderror" name="brand_id">
                        <option value="">Select Brand</option>
                        @foreach($brands as $brand)
                            <option value="{{ $brand->id }}" {{ old('brand_id') == $brand->id ? 'selected' : '' }}>
                                {{ $brand->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('brand_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label class="form-label">Category</label>
                    <select class="form-select @error('category_id') is-invalid @enderror" name="category_id">
                        <option value="">Select Category</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label class="form-label">Price</label>
                    <input class="form-control @error('price') is-invalid @enderror"
                           name="price" type="number" step="0.01" min="0"
                           value="{{ old('price') }}" placeholder="Enter price">
                    @error('price')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label class="form-label">Sort Order</label>
                    <input class="form-control @error('sort_order') is-invalid @enderror"
                           name="sort_order" type="number" value="{{ old('sort_order', 0) }}" min="0">
                    @error('sort_order')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-3">
                    <label class="form-label">Status <span class="text-danger">*</span></label>
                    <select class="form-select @error('status') is-invalid @enderror" name="status" required>
                        <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active</option>
                        <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                    </select>
                    @error('status')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-3">
                    <label class="form-label">New <span class="text-danger">*</span></label>
                    <select class="form-select @error('new') is-invalid @enderror" name="new" required>
                        <option value="inactive" {{ old('new') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                        <option value="active" {{ old('new') == 'active' ? 'selected' : '' }}>Active</option>
                    </select>
                    @error('new')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-3">
                    <label class="form-label">Trending <span class="text-danger">*</span></label>
                    <select class="form-select @error('trending') is-invalid @enderror" name="trending" required>
                        <option value="inactive" {{ old('trending') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                        <option value="active" {{ old('trending') == 'active' ? 'selected' : '' }}>Active</option>
                    </select>
                    @error('trending')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-3">
                    <label class="form-label">Show on Home <span class="text-danger">*</span></label>
                    <select class="form-select @error('show_on_home_page') is-invalid @enderror" name="show_on_home_page" required>
                        <option value="inactive" {{ old('show_on_home_page') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                        <option value="active" {{ old('show_on_home_page') == 'active' ? 'selected' : '' }}>Active</option>
                    </select>
                    @error('show_on_home_page')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-12">
                    <label class="form-label">Thumbnail</label>
                    <input class="form-control @error('thumbnail') is-invalid @enderror"
                           name="thumbnail" type="file" accept="image/*">
                    <small class="text-muted">Recommended size: 800x800 pixels, Max size: 2MB</small>
                    @error('thumbnail')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-12">
                    <label class="form-label">Product Galleries</label>
                    <input class="form-control @error('galleries') is-invalid @enderror"
                           name="galleries[]" type="file" accept="image/*" multiple>
                    <small class="text-muted">You can select multiple images. Max size: 2MB each.</small>
                    @error('galleries')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-12">
                    <label class="form-label">Short Description</label>
                    <textarea class="form-control @error('short_description') is-invalid @enderror"
                              name="short_description" rows="2"
                              placeholder="Brief summary of the product">{{ old('short_description') }}</textarea>
                    <small class="text-muted">Short description displayed in product listings</small>
                    @error('short_description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-12">
                    <label class="form-label">Description</label>
                    <textarea class="form-control @error('description') is-invalid @enderror ckeditor"
                              id="productDescription" name="description" rows="15"
                              placeholder="Write your product description here...">{{ old('description') }}</textarea>
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="d-flex flex-wrap justify-content-end gap-2 mt-4">
                <a class="btn btn-outline-secondary" href="{{ route('admin.product') }}">Cancel</a>
                <button class="btn btn-primary" type="submit">
                    <i class="bi bi-check-circle"></i> Create Product
                </button>
            </div>
        </form>
    </div>

    <!-- Sidebar -->
    <div class="col-12 col-xl-4">
        <div class="panel h-100">
            <h2 class="h5 mb-3 section-title">
                <i class="bi bi-list-check"></i>
                <span>Product Checklist</span>
            </h2>
            <div class="activity-list">
                <div class="activity-item">
                    <span class="activity-dot bg-success"></span>
                    <div>
                        <p class="mb-1 fw-semibold">Name & Slug</p>
                        <p class="text-muted small">Enter product name and unique slug.</p>
                    </div>
                </div>
                <div class="activity-item">
                    <span class="activity-dot bg-primary"></span>
                    <div>
                        <p class="mb-1 fw-semibold">Brand & Category</p>
                        <p class="text-muted small">Assign brand and category.</p>
                    </div>
                </div>
                <div class="activity-item">
                    <span class="activity-dot bg-warning"></span>
                    <div>
                        <p class="mb-1 fw-semibold">Thumbnail & Gallery</p>
                        <p class="text-muted small">Add product images.</p>
                    </div>
                </div>
                <div class="activity-item">
                    <span class="activity-dot bg-info"></span>
                    <div>
                        <p class="mb-1 fw-semibold">Description</p>
                        <p class="text-muted small">Write detailed product description.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('styles')
<style>
    .ck-editor__editable { min-height: 350px; max-height: 600px; }
    .ck-content { font-size: 14px; line-height: 1.6; }
    .ck-content h1 { font-size: 28px !important; }
    .ck-content h2 { font-size: 24px !important; }
    .ck-content h3 { font-size: 20px !important; }
    .ck-content h4 { font-size: 18px !important; }
    .ck-content img { max-width: 100%; height: auto; }
    .ck-content ul, .ck-content ol { padding-left: 20px !important; }
    .ck-content blockquote {
        border-left: 4px solid #0d6efd;
        padding-left: 15px;
        margin-left: 0;
        color: #6c757d;
    }
    .ck-content table { border-collapse: collapse; width: 100%; }
    .ck-content table td, .ck-content table th { border: 1px solid #dee2e6; padding: 8px; }
    .panel form .form-control.ckeditor { visibility: hidden; height: 0; padding: 0; margin: 0; }
    .panel form .ck-editor { margin-bottom: 0.5rem; }
    .ck-toolbar { border-radius: 4px 4px 0 0 !important; }
    .ck-editor__editable { border-radius: 0 0 4px 4px !important; }
    .ck-editor__editable .ck-placeholder { color: #adb5bd !important; }
</style>
@endpush

@push('scripts')
<script src="https://cdn.ckeditor.com/ckeditor5/41.4.2/classic/ckeditor.js"></script>
<script>
$(document).ready(function() {
    let editorInstance = null;

    ClassicEditor
        .create(document.querySelector('#productDescription'), {
            toolbar: {
                items: [
                    'heading', '|',
                    'bold', 'italic', 'underline', 'strikethrough', 'subscript', 'superscript', '|',
                    'link', 'blockQuote', 'codeBlock', '|',
                    'bulletedList', 'numberedList', '|',
                    'outdent', 'indent', '|',
                    'alignment', '|',
                    'fontSize', 'fontFamily', 'fontColor', 'fontBackgroundColor', '|',
                    'highlight', '|',
                    'insertTable', 'mediaEmbed', '|',
                    'undo', 'redo', '|',
                    'removeFormat', '|',
                    'findAndReplace', '|',
                    'sourceEditing'
                ]
            },
            heading: {
                options: [
                    { model: 'paragraph', title: 'Paragraph', class: 'ck-heading_paragraph' },
                    { model: 'heading1', view: 'h1', title: 'Heading 1', class: 'ck-heading_heading1' },
                    { model: 'heading2', view: 'h2', title: 'Heading 2', class: 'ck-heading_heading2' },
                    { model: 'heading3', view: 'h3', title: 'Heading 3', class: 'ck-heading_heading3' },
                    { model: 'heading4', view: 'h4', title: 'Heading 4', class: 'ck-heading_heading4' }
                ]
            },
            fontSize: { options: ['tiny', 'small', 'default', 'big', 'huge'] },
            fontFamily: {
                options: [
                    'default',
                    'Arial, Helvetica, sans-serif',
                    'Courier New, Courier, monospace',
                    'Georgia, serif',
                    'Times New Roman, Times, serif',
                    'Verdana, Geneva, sans-serif'
                ]
            },
            alignment: { options: ['left', 'center', 'right', 'justify'] },
            table: {
                contentToolbar: ['tableColumn', 'tableRow', 'mergeTableCells', 'tableProperties', 'tableCellProperties']
            },
            language: 'en',
            placeholder: 'Write your product description here...'
        })
        .then(editor => {
            editorInstance = editor;
            document.querySelector('#productForm').addEventListener('submit', function(e) {
                document.querySelector('#productDescription').value = editorInstance.getData();
            });
        })
        .catch(error => { console.error('CKEditor initialization failed:', error); });

    $('#generateSlug').on('click', function() {
        const name = $('input[name="name"]').val();
        if (!name) {
            Swal.fire('Warning', 'Please enter a name first!', 'warning');
            return;
        }
        $.ajax({
            url: '{{ route("admin.product.generate-slug") }}',
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