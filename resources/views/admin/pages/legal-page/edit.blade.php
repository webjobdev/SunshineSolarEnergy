@extends('admin.layouts.app')

@section('title', 'Edit ' . $page->type_label)

@section('content')
<div class="page-heading">
    <div class="page-heading-copy">
        <span class="page-icon"><i class="bi bi-pencil-square"></i></span>
        <div>
            <p class="eyebrow mb-1">Content Management</p>
            <h1 class="h3 mb-1">Edit {{ $page->type_label }}</h1>
            <p class="text-muted mb-0">Update the title and content for "{{ $page->type_label }}".</p>
        </div>
    </div>
    <div class="heading-actions">
        <a class="btn btn-outline-secondary btn-sm" href="{{ route('admin.legal-page') }}">
            <i class="bi bi-arrow-left"></i> Back to Legal Pages
        </a>
    </div>
</div>

<section class="row g-3">
    <div class="col-12 col-xl-8">
        <form class="panel" action="{{ route('admin.legal-page.update', $page->type) }}" method="POST" id="legalPageForm">
            @csrf
            @method('PUT')

            <div class="panel-header">
                <div>
                    <h2 class="h5 mb-1 section-title">
                        <i class="bi bi-file-earmark-text"></i>
                        <span>Page Information</span>
                    </h2>
                    <p class="text-muted mb-0">Update title and description.</p>
                </div>
                <div>
                    <span class="badge bg-light text-dark">
                        <i class="bi bi-clock me-1"></i>
                        Last updated: {{ $page->updated_at->format('M d, Y H:i') }}
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
                <div class="col-12">
                    <label class="form-label">Page Type</label>
                    <input class="form-control" type="text" value="{{ $page->type_label }}" disabled>
                    <small class="text-muted">Page type cannot be changed.</small>
                </div>

                <div class="col-12">
                    <label class="form-label" for="title">
                        Title <span class="text-danger">*</span>
                    </label>
                    <input class="form-control @error('title') is-invalid @enderror"
                           id="title" name="title" type="text"
                           value="{{ old('title', $page->title) }}"
                           placeholder="Enter page title" required>
                    @error('title')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-12">
                    <label class="form-label" for="description">Description</label>
                    <textarea class="form-control @error('description') is-invalid @enderror ckeditor"
                              id="legalPageDescription" name="description" rows="15"
                              placeholder="Write your content here...">{{ old('description', $page->description) }}</textarea>
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="d-flex flex-wrap justify-content-end gap-2 mt-4">
                <a class="btn btn-outline-secondary" href="{{ route('admin.legal-page') }}">
                    <i class="bi bi-x-circle"></i> Cancel
                </a>
                <button class="btn btn-primary" type="submit">
                    <i class="bi bi-check-circle"></i> Update Page
                </button>
            </div>
        </form>
    </div>

    <!-- Sidebar -->
    <div class="col-12 col-xl-4">
        <div class="panel h-100">
            <h2 class="h5 mb-3 section-title">
                <i class="bi bi-list-check"></i>
                <span>Page Checklist</span>
            </h2>
            <div class="activity-list">
                <div class="activity-item">
                    <span class="activity-dot {{ $page->title ? 'bg-success' : 'bg-warning' }}"></span>
                    <div>
                        <p class="mb-1 fw-semibold">Title</p>
                        <p class="text-muted small mb-0">
                            {{ $page->title ? 'Title is set' : 'Title is missing' }}
                        </p>
                    </div>
                </div>
                <div class="activity-item">
                    <span class="activity-dot {{ $page->description ? 'bg-success' : 'bg-warning' }}"></span>
                    <div>
                        <p class="mb-1 fw-semibold">Description</p>
                        <p class="text-muted small mb-0">
                            {{ $page->description ? 'Description is set' : 'Description is empty' }}
                        </p>
                    </div>
                </div>
                <div class="activity-item">
                    <span class="activity-dot bg-info"></span>
                    <div>
                        <p class="mb-1 fw-semibold">Page Type</p>
                        <p class="text-muted small mb-0">{{ $page->type_label }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('styles')
<style>
    .ck-editor__editable { min-height: 350px; max-height: 700px; }
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
        .create(document.querySelector('#legalPageDescription'), {
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
            placeholder: 'Write your content here...'
        })
        .then(editor => {
            editorInstance = editor;

            document.querySelector('#legalPageForm').addEventListener('submit', function(e) {
                document.querySelector('#legalPageDescription').value = editorInstance.getData();
            });
        })
        .catch(error => { console.error('CKEditor initialization failed:', error); });

    setTimeout(function() { $('.alert').fadeOut('slow'); }, 5000);
});
</script>
@endpush