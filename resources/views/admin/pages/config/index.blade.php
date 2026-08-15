@extends('admin.layouts.app')

@section('title', 'Website Configurations')

@section('content')
    <div class="page-heading">
        <div class="page-heading-copy">
            <span class="page-icon"><i class="bi bi-gear-wide-connected"></i></span>
            <div>
                <p class="eyebrow mb-1">System Settings</p>
                <h1 class="h3 mb-1">Website Configurations</h1>
                <p class="text-muted mb-0">Manage all website settings including logo, favicon, contact info, and social
                    links.</p>
            </div>
        </div>
        <div class="heading-actions">
            <a class="btn btn-primary btn-sm" href="{{ route('admin.config.create') }}">
                <i class="bi bi-plus-circle"></i> Add Configuration
            </a>
        </div>
    </div>

    <!-- Group Tabs -->
    <ul class="nav nav-tabs mb-3">
        @foreach ($configGroups as $key => $label)
            <li class="nav-item">
                <a class="nav-link {{ $currentGroup == $key ? 'active' : '' }}"
                    href="{{ route('admin.config', ['group' => $key]) }}">
                    {{ $label }}
                </a>
            </li>
        @endforeach
    </ul>

    <!-- Configurations Form -->
    <form action="{{ route('admin.config.bulk-update') }}" method="POST">
        @csrf
        <input type="hidden" name="group" value="{{ $currentGroup }}">

        <div class="card">
            <div class="card-body">
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                <div class="row">
                    @forelse($configurations as $config)
                        <div class="col-md-6 mb-3">
                            <div class="config-item">
                                <label class="form-label">
                                    {{ $config->config_label }}
                                    <small class="text-muted">({{ $config->config_key }})</small>
                                    @if ($config->is_required)
                                        <span class="text-danger">*</span>
                                    @endif
                                </label>

                                @if ($config->config_help)
                                    <small class="text-muted d-block">{{ $config->config_help }}</small>
                                @endif

                                @switch($config->config_type)
                                    @case('image')
                                        <div class="image-upload-wrapper">
                                            <div class="current-image mb-2">
                                                @if ($config->config_value)
                                                    <div class="d-flex align-items-center gap-2">
                                                        <img src="{{ $config->image_url }}" alt="{{ $config->config_label }}"
                                                            class="img-thumbnail" style="max-height: 100px; max-width: 200px;">
                                                        <button type="button" class="btn btn-danger btn-sm remove-image"
                                                            data-key="{{ $config->config_key }}"
                                                            data-label="{{ $config->config_label }}">
                                                            <i class="bi bi-trash"></i> Remove
                                                        </button>
                                                    </div>
                                                @else
                                                    <div class="text-muted small">No image uploaded</div>
                                                @endif
                                            </div>
                                            <input type="file" class="form-control config-image-upload"
                                                data-key="{{ $config->config_key }}" accept="image/*">
                                            <input type="hidden" name="configs[{{ $config->config_key }}]"
                                                value="{{ $config->config_value }}">
                                            <div class="image-preview mt-2"></div>
                                            <div class="upload-progress mt-2" style="display: none;">
                                                <div class="progress">
                                                    <div class="progress-bar progress-bar-striped progress-bar-animated"
                                                        role="progressbar" style="width: 0%"></div>
                                                </div>
                                                <small class="text-muted">Uploading...</small>
                                            </div>
                                        </div>
                                    @break

                                    @case('boolean')
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox"
                                                name="configs[{{ $config->config_key }}]" value="1"
                                                {{ $config->config_value ? 'checked' : '' }}>
                                        </div>
                                    @break

                                    @case('textarea')
                                        <textarea class="form-control" name="configs[{{ $config->config_key }}]" rows="3"
                                            placeholder="{{ $config->config_placeholder }}">{{ $config->config_value }}</textarea>
                                    @break

                                    @default
                                        <input class="form-control" type="{{ $config->config_type }}"
                                            name="configs[{{ $config->config_key }}]" value="{{ $config->config_value }}"
                                            placeholder="{{ $config->config_placeholder }}">
                                @endswitch
                            </div>
                        </div>
                        @empty
                            <div class="col-12">
                                <div class="text-center py-4">
                                    <i class="bi bi-gear display-4 text-muted d-block mb-3"></i>
                                    <h5>No Configurations Found</h5>
                                    <p class="text-muted">Add configurations for this group.</p>
                                    <a href="{{ route('admin.config.create') }}" class="btn btn-primary btn-sm mt-2">
                                        <i class="bi bi-plus-circle"></i> Add Configuration
                                    </a>
                                </div>
                            </div>
                        @endforelse
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-save"></i> Save All Settings
                    </button>
                </div>
            </div>
        </form>
    @endsection

    @push('styles')
        <style>
            .config-item {
                padding: 0.75rem;
                background: #f8f9fa;
                border-radius: 0.5rem;
                border: 1px solid #e9ecef;
            }

            .config-item .form-label {
                font-weight: 500;
                font-size: 0.875rem;
            }

            .image-upload-wrapper .current-image img {
                object-fit: contain;
                max-width: 100%;
            }

            .nav-tabs .nav-link {
                color: #6c757d;
            }

            .nav-tabs .nav-link.active {
                color: #0d6efd;
                font-weight: 600;
            }
        </style>
    @endpush

    @push('scripts')
        <script>
            $(document).ready(function() {
                // Image Upload
                $('.config-image-upload').on('change', function() {
                    const file = this.files[0];
                    const key = $(this).data('key');
                    const $preview = $(this).closest('.image-upload-wrapper').find('.image-preview');
                    const $hiddenInput = $(this).closest('.image-upload-wrapper').find('input[type="hidden"]');

                    if (!file) return;

                    // Show preview
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        $preview.html('<img src="' + e.target.result +
                            '" class="img-thumbnail" style="max-height: 100px;">');
                    };
                    reader.readAsDataURL(file);

                    // Upload image via AJAX
                    const formData = new FormData();
                    formData.append('image', file);
                    formData.append('config_key', key);
                    formData.append('_token', '{{ csrf_token() }}');

                    $.ajax({
                        url: '{{ route('admin.config.upload-image') }}',
                        type: 'POST',
                        data: formData,
                        processData: false,
                        contentType: false,
                        success: function(response) {
                            if (response.status) {
                                $hiddenInput.val(response.path.replace('/storage/', ''));
                                Swal.fire('Success!', response.message, 'success');
                            }
                        },
                        error: function(xhr) {
                            Swal.fire('Error!', xhr.responseJSON?.message || 'Upload failed',
                                'error');
                        }
                    });
                });
            });
            // Remove Image
$('.remove-image').on('click', function() {
    const key = $(this).data('key');
    const label = $(this).data('label');
    
    Swal.fire({
        title: 'Remove Image?',
        html: "You are about to remove the image for: <strong>" + label + "</strong>",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: '<i class="bi bi-trash me-2"></i>Yes, remove it!',
        cancelButtonText: 'Cancel',
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            Swal.fire({
                title: 'Removing...',
                text: 'Please wait',
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });
            
            $.ajax({
                url: '{{ route("admin.config.remove-image") }}',
                type: 'POST',
                data: {
                    config_key: key,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    if (response.status) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Removed!',
                            text: response.message,
                            confirmButtonText: 'OK'
                        }).then(() => {
                            location.reload();
                        });
                    }
                },
                error: function(xhr) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: xhr.responseJSON?.message || 'Something went wrong!'
                    });
                }
            });
        }
    });
});

// Image Upload with Progress
$('.config-image-upload').on('change', function() {
    const file = this.files[0];
    const key = $(this).data('key');
    const $wrapper = $(this).closest('.image-upload-wrapper');
    const $preview = $wrapper.find('.image-preview');
    const $hiddenInput = $wrapper.find('input[type="hidden"]');
    const $progress = $wrapper.find('.upload-progress');
    const $progressBar = $progress.find('.progress-bar');
    
    if (!file) return;
    
    // Show preview
    const reader = new FileReader();
    reader.onload = function(e) {
        $preview.html('<img src="' + e.target.result + '" class="img-thumbnail" style="max-height: 100px;">');
    };
    reader.readAsDataURL(file);
    
    // Show progress
    $progress.show();
    $progressBar.css('width', '0%');
    
    // Upload image via AJAX
    const formData = new FormData();
    formData.append('image', file);
    formData.append('config_key', key);
    formData.append('_token', '{{ csrf_token() }}');
    
    $.ajax({
        url: '{{ route("admin.config.upload-image") }}',
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        xhr: function() {
            const xhr = new window.XMLHttpRequest();
            xhr.upload.addEventListener('progress', function(e) {
                if (e.lengthComputable) {
                    const percent = Math.round((e.loaded / e.total) * 100);
                    $progressBar.css('width', percent + '%');
                }
            });
            return xhr;
        },
        success: function(response) {
            if (response.status) {
                $hiddenInput.val(response.path.replace('/storage/', ''));
                $progress.hide();
                $progressBar.css('width', '0%');
                
                Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    text: response.message,
                    timer: 2000,
                    showConfirmButton: false
                }).then(() => {
                    location.reload();
                });
            }
        },
        error: function(xhr) {
            $progress.hide();
            $progressBar.css('width', '0%');
            $preview.html('');
            
            Swal.fire({
                icon: 'error',
                title: 'Error!',
                text: xhr.responseJSON?.message || 'Upload failed',
                confirmButtonText: 'OK'
            });
        }
    });
});
        </script>
    @endpush
