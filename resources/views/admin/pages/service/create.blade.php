@extends('admin.layouts.app')

@section('title', 'Create Service')

@section('content')
<div class="page-heading">
    <div class="page-heading-copy">
        <span class="page-icon"><i class="bi bi-plus-circle"></i></span>
        <div>
            <p class="eyebrow mb-1">Content Management</p>
            <h1 class="h3 mb-1">Create Service</h1>
            <p class="text-muted mb-0">Add a new service.</p>
        </div>
    </div>
    <div class="heading-actions">
        <a class="btn btn-outline-secondary btn-sm" href="{{ route('admin.service') }}">
            <i class="bi bi-arrow-left"></i> Back to Services
        </a>
    </div>
</div>

<section class="row g-3">
    <div class="col-12 col-xl-8">
        <form class="panel" action="{{ route('admin.service.store') }}" method="POST" enctype="multipart/form-data" id="serviceForm">
            @csrf

            <div class="panel-header">
                <div>
                    <h2 class="h5 mb-1 section-title">
                        <i class="bi bi-gear-wide-connected"></i>
                        <span>Service Information</span>
                    </h2>
                    <p class="text-muted mb-0">Enter service details.</p>
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
                           placeholder="Enter service name" required>
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
                    <label class="form-label">Thumbnail</label>
                    <input class="form-control @error('thumbnail') is-invalid @enderror"
                           name="thumbnail" type="file" accept="image/*">
                    <small class="text-muted">Recommended size: 800x600 pixels, Max size: 2MB</small>
                    @error('thumbnail')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-12">
                    <label class="form-label">Short Description</label>
                    <textarea class="form-control @error('short_description') is-invalid @enderror"
                              name="short_description" rows="2"
                              placeholder="Brief summary of the service">{{ old('short_description') }}</textarea>
                    <small class="text-muted">Short description displayed in service listings</small>
                    @error('short_description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-12">
                    <label class="form-label">Description</label>
                    <textarea class="form-control @error('description') is-invalid @enderror ckeditor"
                              id="serviceDescription" name="description" rows="15"
                              placeholder="Write your service description here...">{{ old('description') }}</textarea>
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="d-flex flex-wrap justify-content-end gap-2 mt-4">
                <a class="btn btn-outline-secondary" href="{{ route('admin.service') }}">Cancel</a>
                <button class="btn btn-primary" type="submit">
                    <i class="bi bi-check-circle"></i> Create Service
                </button>
            </div>
        </form>
    </div>

    <!-- Sidebar -->
    <div class="col-12 col-xl-4">
        <div class="panel h-100">
            <h2 class="h5 mb-3 section-title">
                <i class="bi bi-list-check"></i>
                <span>Service Checklist</span>
            </h2>
            <div class="activity-list">
                <div class="activity-item">
                    <span class="activity-dot bg-success"></span>
                    <div>
                        <p class="mb-1 fw-semibold">Name & Slug</p>
                        <p class="text-muted small">Enter service name and unique slug.</p>
                    </div>
                </div>
                <div class="activity-item">
                    <span class="activity-dot bg-primary"></span>
                    <div>
                        <p class="mb-1 fw-semibold">Thumbnail</p>
                        <p class="text-muted small">Add a service thumbnail image.</p>
                    </div>
                </div>
                <div class="activity-item">
                    <span class="activity-dot bg-warning"></span>
                    <div>
                        <p class="mb-1 fw-semibold">Description</p>
                        <p class="text-muted small">Write detailed service description.</p>
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
        .create(document.querySelector('#serviceDescription'), {
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
            placeholder: 'Write your service description here...'
        })
        .then(editor => {
            editorInstance = editor;
            document.querySelector('#serviceForm').addEventListener('submit', function(e) {
                document.querySelector('#serviceDescription').value = editorInstance.getData();
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
            url: '{{ route("admin.service.generate-slug") }}',
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