@extends('admin.layouts.app')

@section('title', 'Edit Blog')

@section('content')
    <div class="page-heading">
        <div class="page-heading-copy">
            <span class="page-icon"><i class="bi bi-pencil-square"></i></span>
            <div>
                <p class="eyebrow mb-1">Content Management</p>
                <h1 class="h3 mb-1">Edit Blog</h1>
                <p class="text-muted mb-0">Update blog post: <strong>{{ $blog->title }}</strong></p>
            </div>
        </div>
        <div class="heading-actions">
            <a class="btn btn-outline-secondary btn-sm" href="{{ route('admin.blog') }}">
                <i class="bi bi-arrow-left"></i> Back to Blogs
            </a>
        </div>
    </div>

    <section class="row g-3">
        <div class="col-12 col-xl-8">
            <form class="panel" action="{{ route('admin.blog.update', $blog->id) }}" method="POST"
                enctype="multipart/form-data" id="blogForm">
                @csrf
                @method('PUT')

                <div class="panel-header">
                    <div>
                        <h2 class="h5 mb-1 section-title">
                            <i class="bi bi-journal-text"></i>
                            <span>Blog Information</span>
                        </h2>
                        <p class="text-muted mb-0">Update blog details and SEO metadata.</p>
                    </div>
                    <div>
                        <span class="badge bg-light text-dark">
                            <i class="bi bi-clock me-1"></i>
                            Updated: {{ $blog->updated_at->format('M d, Y H:i') }}
                        </span>
                        <span class="badge bg-light text-dark ms-1">
                            <i class="bi bi-eye me-1"></i>
                            {{ number_format($blog->views) }} views
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
                        <label class="form-label">Title <span class="text-danger">*</span></label>
                        <input class="form-control @error('title') is-invalid @enderror" name="title" type="text"
                            value="{{ old('title', $blog->title) }}" required>
                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Slug <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <input class="form-control @error('slug') is-invalid @enderror" id="slug" name="slug"
                                type="text" value="{{ old('slug', $blog->slug) }}" required>
                            <button class="btn btn-outline-secondary" type="button" id="generateSlug">
                                <i class="bi bi-magic"></i> Generate
                            </button>
                            @error('slug')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Category</label>
                        <select class="form-select @error('category_id') is-invalid @enderror" name="category_id">
                            <option value="">Select Category</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id', $blog->category_id) == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Status <span class="text-danger">*</span></label>
                        <select class="form-select @error('status') is-invalid @enderror" name="status" required>
                            <option value="draft" {{ old('status', $blog->status) == 'draft' ? 'selected' : '' }}>Draft
                            </option>
                            <option value="published" {{ old('status', $blog->status) == 'published' ? 'selected' : '' }}>
                                Published</option>
                            <option value="archived" {{ old('status', $blog->status) == 'archived' ? 'selected' : '' }}>
                                Archived</option>
                        </select>
                        @error('status')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Published At</label>
                        <input class="form-control @error('published_at') is-invalid @enderror" name="published_at"
                            type="datetime-local"
                            value="{{ old('published_at', $blog->published_at ? $blog->published_at->format('Y-m-d\TH:i') : '') }}">
                        @error('published_at')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Tags</label>
                        <select class="form-select @error('tags') is-invalid @enderror" name="tags[]" multiple>
                            @foreach($tags as $tag)
                                <option value="{{ $tag->id }}" {{ in_array($tag->id, old('tags', $selectedTags)) ? 'selected' : '' }}>
                                    {{ $tag->name }}
                                </option>
                            @endforeach
                        </select>
                        <small class="text-muted">Hold Ctrl/Cmd to select multiple tags</small>
                        @error('tags')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-12">
                        <label class="form-label">Featured Image</label>
                        @if($blog->featured_image)
                            <div class="mb-2 p-2 bg-light rounded">
                                <img src="{{ $blog->featured_image_url }}" width="150" class="rounded" alt="{{ $blog->title }}">
                                <div class="form-check mt-1">
                                    <input class="form-check-input" type="checkbox" name="remove_image" value="1"
                                        id="removeImage">
                                    <label class="form-check-label text-danger" for="removeImage">
                                        <i class="bi bi-trash"></i> Remove current image
                                    </label>
                                </div>
                            </div>
                        @endif
                        <input class="form-control @error('featured_image') is-invalid @enderror" name="featured_image"
                            type="file" accept="image/*">
                        <small class="text-muted">Recommended size: 1200x630 pixels, Max size: 2MB</small>
                        @error('featured_image')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-12">
                        <label class="form-label">Excerpt</label>
                        <textarea class="form-control @error('excerpt') is-invalid @enderror" name="excerpt"
                            rows="2">{{ old('excerpt', $blog->excerpt) }}</textarea>
                        <small class="text-muted">Short description displayed in blog listings (max 500 characters)</small>
                        @error('excerpt')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-12">
                        <label class="form-label">Content <span class="text-danger">*</span></label>
                        <!-- REMOVED required attribute to fix the error -->
                        <textarea class="form-control @error('content') is-invalid @enderror ckeditor" id="blogContent"
                            name="content" rows="15">{{ old('content', $blog->content) }}</textarea>
                        <div id="contentError" class="invalid-feedback" style="display: none;">Blog content is required
                        </div>
                        @error('content')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-12">
                        <h5 class="mt-3 mb-3">SEO Settings</h5>
                        <hr>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Meta Title</label>
                        <input class="form-control @error('meta_title') is-invalid @enderror" name="meta_title" type="text"
                            value="{{ old('meta_title', $blog->meta_title) }}" id="metaTitle">
                        <small class="text-muted"><span id="metaTitleCount">{{ strlen($blog->meta_title ?? '') }}</span>/70
                            characters</small>
                        @error('meta_title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Focus Keyword</label>
                        <input class="form-control @error('focus_keyword') is-invalid @enderror" name="focus_keyword"
                            type="text" value="{{ old('focus_keyword', $blog->focus_keyword) }}">
                        @error('focus_keyword')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Canonical URL</label>
                        <input class="form-control @error('canonical_url') is-invalid @enderror" name="canonical_url"
                            type="url" value="{{ old('canonical_url', $blog->canonical_url) }}">
                        @error('canonical_url')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Robots</label>
                        <select class="form-select @error('robots') is-invalid @enderror" name="robots">
                            @foreach($robotsOptions as $value => $label)
                                <option value="{{ $value }}" {{ old('robots', $blog->robots) == $value ? 'selected' : '' }}>
                                    {{ $label }}
                                </option>
                            @endforeach
                        </select>
                        @error('robots')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-12">
                        <label class="form-label">Meta Description</label>
                        <textarea class="form-control @error('meta_description') is-invalid @enderror"
                            name="meta_description" rows="3"
                            id="metaDescription">{{ old('meta_description', $blog->meta_description) }}</textarea>
                        <small class="text-muted"><span
                                id="metaDescCount">{{ strlen($blog->meta_description ?? '') }}</span>/160 characters</small>
                        @error('meta_description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-12">
                        <label class="form-label">Meta Keywords</label>
                        <textarea class="form-control @error('meta_keywords') is-invalid @enderror" name="meta_keywords"
                            rows="2">{{ old('meta_keywords', $blog->meta_keywords) }}</textarea>
                        <small class="text-muted">Separate keywords with commas (e.g., web, design, development)</small>
                        @error('meta_keywords')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="d-flex flex-wrap justify-content-end gap-2 mt-4">
                    <a class="btn btn-outline-secondary" href="{{ route('admin.blog') }}">Cancel</a>
                    <button class="btn btn-primary" type="submit">
                        <i class="bi bi-check-circle"></i> Update Blog
                    </button>
                </div>
            </form>
        </div>

        <div class="col-12 col-xl-4">
            <div class="panel h-100">
                <h2 class="h5 mb-3 section-title">
                    <i class="bi bi-list-check"></i>
                    <span>SEO Checklist</span>
                </h2>
                <div class="activity-list">
                    <div class="activity-item">
                        <span class="activity-dot {{ $blog->title ? 'bg-success' : 'bg-secondary' }}"></span>
                        <div>
                            <p class="mb-1 fw-semibold">Title</p>
                            <p class="text-muted small">{{ $blog->title ? 'Title is set' : 'Title is missing' }}</p>
                        </div>
                    </div>
                    <div class="activity-item">
                        <span class="activity-dot {{ $blog->meta_title ? 'bg-success' : 'bg-warning' }}"></span>
                        <div>
                            <p class="mb-1 fw-semibold">Meta Title</p>
                            <p class="text-muted small">
                                {{ $blog->meta_title ? 'Meta title is set' : 'Meta title is missing' }}</p>
                        </div>
                    </div>
                    <div class="activity-item">
                        <span class="activity-dot {{ $blog->meta_description ? 'bg-success' : 'bg-warning' }}"></span>
                        <div>
                            <p class="mb-1 fw-semibold">Meta Description</p>
                            <p class="text-muted small">
                                {{ $blog->meta_description ? 'Meta description is set' : 'Meta description is missing' }}
                            </p>
                        </div>
                    </div>
                    <div class="activity-item">
                        <span class="activity-dot {{ $blog->focus_keyword ? 'bg-success' : 'bg-warning' }}"></span>
                        <div>
                            <p class="mb-1 fw-semibold">Focus Keyword</p>
                            <p class="text-muted small">
                                {{ $blog->focus_keyword ? 'Focus keyword: ' . $blog->focus_keyword : 'Focus keyword is missing' }}
                            </p>
                        </div>
                    </div>
                    <div class="activity-item">
                        <span class="activity-dot {{ $blog->featured_image ? 'bg-success' : 'bg-warning' }}"></span>
                        <div>
                            <p class="mb-1 fw-semibold">Featured Image</p>
                            <p class="text-muted small">
                                {{ $blog->featured_image ? 'Featured image is set' : 'Featured image is missing' }}</p>
                        </div>
                    </div>
                    <div class="activity-item">
                        <span class="activity-dot {{ $blog->status == 'published' ? 'bg-success' : 'bg-warning' }}"></span>
                        <div>
                            <p class="mb-1 fw-semibold">Status</p>
                            <p class="text-muted small">Blog is {{ $blog->status }} on frontend</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('styles')
    <style>
        .ck-editor__editable {
            min-height: 350px;
            max-height: 600px;
        }

        .ck-content {
            font-size: 14px;
            line-height: 1.6;
        }

        .ck-content h1 {
            font-size: 28px !important;
        }

        .ck-content h2 {
            font-size: 24px !important;
        }

        .ck-content h3 {
            font-size: 20px !important;
        }

        .ck-content h4 {
            font-size: 18px !important;
        }

        .ck-content img {
            max-width: 100%;
            height: auto;
        }

        .ck-content ul,
        .ck-content ol {
            padding-left: 20px !important;
        }

        .ck-content blockquote {
            border-left: 4px solid #0d6efd;
            padding-left: 15px;
            margin-left: 0;
            color: #6c757d;
        }

        .ck-content table {
            border-collapse: collapse;
            width: 100%;
        }

        .ck-content table td,
        .ck-content table th {
            border: 1px solid #dee2e6;
            padding: 8px;
        }

        .panel form .form-control.ckeditor {
            visibility: hidden;
            height: 0;
            padding: 0;
            margin: 0;
        }

        .panel form .ck-editor {
            margin-bottom: 0.5rem;
        }

        .ck-toolbar {
            border-radius: 4px 4px 0 0 !important;
        }

        .ck-editor__editable {
            border-radius: 0 0 4px 4px !important;
        }

        .ck-editor__editable .ck-placeholder {
            color: #adb5bd !important;
        }

        .bg-light {
            background-color: #f8f9fa !important;
        }
    </style>
@endpush

@push('scripts')
    

    <!-- CKEditor CDN -->
    <script src="https://cdn.ckeditor.com/ckeditor5/41.4.2/classic/ckeditor.js"></script>

    <script>
        $(document).ready(function () {
            let editorInstance = null;

            // Initialize CKEditor with full features
            ClassicEditor
                .create(document.querySelector('#blogContent'), {
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
                            // 'imageUpload', 
                            // 'imageInsert', 
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
                    fontSize: {
                        options: [
                            'tiny', 'small', 'default', 'big', 'huge'
                        ]
                    },
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
                    alignment: {
                        options: ['left', 'center', 'right', 'justify']
                    },
                    image: {
                        toolbar: [
                            'imageStyle:alignLeft',
                            'imageStyle:alignCenter',
                            'imageStyle:alignRight',
                            'imageStyle:alignBlockLeft',
                            'imageStyle:alignBlockRight',
                            '|',
                            'imageTextAlternative',
                            '|',
                            'imageResize'
                        ]
                    },
                    table: {
                        contentToolbar: ['tableColumn', 'tableRow', 'mergeTableCells', 'tableProperties', 'tableCellProperties']
                    },
                    language: 'en',
                    placeholder: 'Write your blog content here...'
                })
                .then(editor => {
                    editorInstance = editor;
                    console.log('CKEditor initialized successfully');

                    // Handle form submission - update textarea before submit
                    document.querySelector('#blogForm').addEventListener('submit', function (e) {
                        const content = editorInstance.getData();
                        document.querySelector('#blogContent').value = content;

                        // Validate content
                        const contentText = content.replace(/<[^>]*>/g, '').trim();
                        if (contentText.length === 0) {
                            e.preventDefault();
                            $('#contentError').show();
                            $('#blogContent').addClass('is-invalid');
                            Swal.fire({
                                icon: 'error',
                                title: 'Validation Error',
                                text: 'Blog content is required!'
                            });
                            return false;
                        }

                        $('#contentError').hide();
                        $('#blogContent').removeClass('is-invalid');
                        return true;
                    });

                    // Remove error on content change
                    editor.model.document.on('change', function () {
                        const content = editorInstance.getData();
                        const contentText = content.replace(/<[^>]*>/g, '').trim();
                        if (contentText.length > 0) {
                            $('#contentError').hide();
                            $('#blogContent').removeClass('is-invalid');
                        }
                    });
                })
                .catch(error => {
                    console.error('CKEditor initialization failed:', error);
                });

            // Generate Slug
            $('#generateSlug').on('click', function () {
                const title = $('input[name="title"]').val();
                if (!title) {
                    Swal.fire('Warning', 'Please enter a title first!', 'warning');
                    return;
                }
                $.ajax({
                    url: '{{ route("admin.blog.generate-slug") }}',
                    type: 'POST',
                    data: { title: title, _token: '{{ csrf_token() }}' },
                    success: function (response) {
                        if (response.status) {
                            $('#slug').val(response.slug);
                        }
                    },
                    error: function () {
                        Swal.fire('Error', 'Failed to generate slug!', 'error');
                    }
                });
            });

            // Meta Title Character Counter
            $('#metaTitle').on('input', function () {
                const count = $(this).val().length;
                $('#metaTitleCount').text(count);
                if (count > 70) {
                    $('#metaTitleCount').css('color', 'red');
                } else {
                    $('#metaTitleCount').css('color', '#6c757d');
                }
            });

            // Meta Description Character Counter
            $('#metaDescription').on('input', function () {
                const count = $(this).val().length;
                $('#metaDescCount').text(count);
                if (count > 160) {
                    $('#metaDescCount').css('color', 'red');
                } else {
                    $('#metaDescCount').css('color', '#6c757d');
                }
            });

            // Auto dismiss alerts
            setTimeout(function () {
                $('.alert').fadeOut('slow');
            }, 5000);
        });
    </script>
@endpush