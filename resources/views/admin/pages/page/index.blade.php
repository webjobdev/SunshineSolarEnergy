@extends('admin.layouts.app')

@section('title', 'Pages')

@section('content')
    <!-- Page Heading -->
    <div class="page-heading">
        <div class="page-heading-copy">
            <span class="page-icon"><i class="bi bi-files" aria-hidden="true"></i></span>
            <div>
                <p class="eyebrow mb-1">Content Management</p>
                <h1 class="h3 mb-1">Pages</h1>
                <p class="text-muted mb-0">Manage all website pages, including home, about, services, contact, and custom pages. Control SEO settings, meta tags, and page visibility.</p>
            </div>
        </div>
        <div class="heading-actions">
            <a class="btn btn-outline-secondary btn-sm" href="{{ route('admin.page') }}">
                <i class="bi bi-arrow-clockwise" aria-hidden="true"></i> Refresh
            </a>
            <a class="btn btn-primary btn-sm" href="{{ route('admin.page.create') }}">
                <i class="bi bi-file-earmark-plus" aria-hidden="true"></i> Add Page
            </a>
        </div>
    </div>

    <!-- Main Panel -->
    <section class="panel mt-3">
        <div class="panel-header">
            <div>
                <h2 class="h5 mb-1 section-title">
                    <i class="bi bi-table" aria-hidden="true"></i>
                    <span>Page List</span>
                </h2>
                <p class="text-muted mb-0">Search, review, and manage all website pages and their SEO settings.</p>
            </div>
            <div class="d-flex flex-wrap gap-2">
                <input class="form-control form-control-sm table-search" type="search" 
                       placeholder="Search pages..." data-table-search="pagesTable" 
                       aria-label="Search pages" id="searchPages">
            </div>
        </div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show mx-3 mt-2" role="alert">
                <i class="bi bi-check-circle-fill me-2"></i>
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show mx-3 mt-2" role="alert">
                <i class="bi bi-exclamation-circle-fill me-2"></i>
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="table-responsive">
            <table class="table align-middle mb-0" id="pagesTable" data-searchable-table>
                <thead>
                    <tr>
                        <th scope="col" width="50">#</th>
                        <th scope="col">Page Name</th>
                        <th scope="col">Slug</th>
                        <th scope="col">Focus Keyword</th>
                        <th scope="col">Robots</th>
                        <th scope="col">Status</th>
                        <th scope="col" class="text-end">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pageList as $page)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                <div class="d-flex align-items-center gap-2">
                                    <span class="page-status-indicator">
                                        @if($page->status == 'active')
                                            <i class="bi bi-circle-fill text-success" style="font-size: 0.5rem;"></i>
                                        @else
                                            <i class="bi bi-circle-fill text-muted" style="font-size: 0.5rem;"></i>
                                        @endif
                                    </span>
                                    <div>
                                        <p class="fw-semibold mb-0">{{ $page->page_name }}</p>
                                        <p class="text-muted small mb-0">
                                            <i class="bi bi-tag me-1"></i>
                                            {{ Str::limit($page->meta_title ?? 'No meta title', 30) }}
                                        </p>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span class="badge bg-light text-dark">
                                    <i class="bi bi-link-45deg me-1"></i>
                                    {{ $page->slug }}
                                </span>
                            </td>
                            <td>
                                @if($page->focus_keyword)
                                    <span class="badge bg-info-subtle text-info">
                                        <i class="bi bi-tag me-1"></i>
                                        {{ $page->focus_keyword }}
                                    </span>
                                @else
                                    <span class="text-muted">N/A</span>
                                @endif
                            </td>
                            <td>
                                <span class="badge bg-light text-dark">
                                    {{ $page->robots_label }}
                                </span>
                            </td>
                            <td>
                                {!! $page->status_badge !!}
                            </td>
                            <td class="text-end">
                                <div class="d-flex justify-content-end gap-1">
                                    <a href="{{ route('admin.page.edit', $page->id) }}" 
                                       class="btn btn-light btn-sm" 
                                       title="Edit Page">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <button type="button" 
                                            class="btn btn-light btn-sm delete-page" 
                                            data-id="{{ $page->id }}" 
                                            data-name="{{ $page->page_name }}"
                                            title="Delete Page">
                                        <i class="bi bi-trash text-danger"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-5">
                                <div class="empty-state">
                                    <i class="bi bi-file-earmark-plus display-4 text-muted d-block mb-3"></i>
                                    <h5>No Pages Found</h5>
                                    <p class="text-muted">Start creating your first page to manage content.</p>
                                    <a href="{{ route('admin.page.create') }}" class="btn btn-primary btn-sm mt-2">
                                        <i class="bi bi-file-earmark-plus" aria-hidden="true"></i> Create Page
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="d-flex flex-column flex-sm-row align-items-sm-center justify-content-between gap-3 mt-3">
            <p class="text-muted small mb-0">
                Showing {{ $pageList->firstItem() ?? 0 }} to {{ $pageList->lastItem() ?? 0 }} of {{ $pageList->total() }} pages
            </p>
            <nav aria-label="Pages pagination">
                {{ $pageList->links('pagination::bootstrap-4') }}
            </nav>
        </div>
    </section>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        // Delete page with SweetAlert
        $('.delete-page').on('click', function() {
            const pageId = $(this).data('id');
            const pageName = $(this).data('name');

            Swal.fire({
                title: 'Are you sure?',
                html: "You want to delete page: <strong>" + pageName + "</strong>?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: '<i class="bi bi-trash me-2"></i>Yes, delete it!',
                cancelButtonText: '<i class="bi bi-x-circle me-2"></i>Cancel',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    // Show loading
                    Swal.fire({
                        title: 'Deleting...',
                        text: 'Please wait',
                        allowOutsideClick: false,
                        didOpen: () => {
                            Swal.showLoading();
                        }
                    });

                    $.ajax({
                        url: '{{ route("admin.page.delete", ":id") }}'.replace(':id', pageId),
                        type: 'DELETE',
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            if (response.status) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Deleted!',
                                    text: response.message,
                                    confirmButtonText: '<i class="bi bi-check-circle me-2"></i>OK'
                                }).then(() => {
                                    location.reload();
                                });
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error!',
                                    text: response.message || 'Something went wrong!'
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

        // Auto dismiss alerts after 5 seconds
        setTimeout(function() {
            $('.alert').fadeOut('slow');
        }, 5000);

        // Search functionality
        $('#searchPages').on('keyup', function() {
            const searchValue = $(this).val().toLowerCase();
            $('#pagesTable tbody tr').filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(searchValue) > -1);
            });
        });
    });
</script>
@endpush