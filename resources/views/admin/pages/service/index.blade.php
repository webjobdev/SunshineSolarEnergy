@extends('admin.layouts.app')

@section('title', 'Services')

@section('content')
<div class="page-heading">
    <div class="page-heading-copy">
        <span class="page-icon"><i class="bi bi-gear-wide-connected"></i></span>
        <div>
            <p class="eyebrow mb-1">Content Management</p>
            <h1 class="h3 mb-1">Services</h1>
            <p class="text-muted mb-0">Manage all services offered.</p>
        </div>
    </div>
    <div class="heading-actions">
        <a class="btn btn-primary btn-sm" href="{{ route('admin.service.create') }}">
            <i class="bi bi-plus-circle"></i> Add Service
        </a>
    </div>
</div>

<div class="panel mt-3">
    <div class="panel-header">
        <div>
            <h2 class="h5 mb-1 section-title">
                <i class="bi bi-table"></i>
                <span>Service List</span>
            </h2>
            <p class="text-muted mb-0">Search, review, and manage all services.</p>
        </div>
        <div class="d-flex flex-wrap gap-2">
            <input class="form-control form-control-sm table-search" type="search"
                   placeholder="Search services..." id="searchServices">
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show mx-3 mt-2">
            <i class="bi bi-check-circle-fill me-2"></i>
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show mx-3 mt-2">
            <i class="bi bi-exclamation-circle-fill me-2"></i>
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="table-responsive">
        <table class="table align-middle mb-0" id="servicesTable">
            <thead>
                <tr>
                    <th width="50">#</th>
                    <th>Thumbnail</th>
                    <th>Name</th>
                    <th>Slug</th>
                    <th>Short Description</th>
                    <th>Sort Order</th>
                    <th>Status</th>
                    <th class="text-end">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($services as $service)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>
                            @if($service->thumbnail)
                                <img src="{{ $service->thumbnail_url }}" width="50" height="50" class="rounded" alt="{{ $service->name }}">
                            @else
                                <span class="text-muted">No image</span>
                            @endif
                        </td>
                        <td>
                            <p class="fw-semibold mb-0">{{ $service->name }}</p>
                        </td>
                        <td>
                            <span class="badge bg-light text-dark">
                                <i class="bi bi-link-45deg me-1"></i>
                                {{ Str::limit($service->slug, 30) }}
                            </span>
                        </td>
                        <td>{{ Str::limit($service->excerpt, 50) }}</td>
                        <td>{{ $service->sort_order }}</td>
                        <td>{!! $service->status_badge !!}</td>
                        <td class="text-end">
                            <div class="d-flex justify-content-end gap-1">
                                <a href="{{ route('admin.service.edit', $service->id) }}"
                                   class="btn btn-light btn-sm" title="Edit">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <button type="button"
                                        class="btn btn-light btn-sm delete-service"
                                        data-id="{{ $service->id }}"
                                        data-name="{{ $service->name }}"
                                        title="Delete">
                                    <i class="bi bi-trash text-danger"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center py-5">
                            <div class="empty-state">
                                <i class="bi bi-gear-wide-connected display-4 text-muted d-block mb-3"></i>
                                <h5>No Services Found</h5>
                                <p class="text-muted">Start creating your first service.</p>
                                <a href="{{ route('admin.service.create') }}" class="btn btn-primary btn-sm mt-2">
                                    <i class="bi bi-plus-circle"></i> Create Service
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
            Showing {{ $services->firstItem() ?? 0 }} to {{ $services->lastItem() ?? 0 }} of {{ $services->total() }} services
        </p>
        <nav aria-label="Services pagination">
            {{ $services->links('pagination::bootstrap-4') }}
        </nav>
    </div>
</div>
@endsection

@push('scripts')
<script>
$(document).ready(function() {
    $('.delete-service').on('click', function() {
        const serviceId = $(this).data('id');
        const serviceName = $(this).data('name');

        Swal.fire({
            title: 'Are you sure?',
            html: "You want to delete service: <strong>" + serviceName + "</strong>?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: '<i class="bi bi-trash me-2"></i>Yes, delete it!',
            cancelButtonText: '<i class="bi bi-x-circle me-2"></i>Cancel',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    title: 'Deleting...',
                    text: 'Please wait',
                    allowOutsideClick: false,
                    didOpen: () => { Swal.showLoading(); }
                });

                $.ajax({
                    url: '{{ route("admin.service.delete", ":id") }}'.replace(':id', serviceId),
                    type: 'DELETE',
                    data: { _token: '{{ csrf_token() }}' },
                    success: function(response) {
                        if (response.status) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Deleted!',
                                text: response.message,
                                confirmButtonText: '<i class="bi bi-check-circle me-2"></i>OK'
                            }).then(() => { location.reload(); });
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

    $('#searchServices').on('keyup', function() {
        const searchValue = $(this).val().toLowerCase();
        $('#servicesTable tbody tr').filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(searchValue) > -1);
        });
    });

    setTimeout(function() { $('.alert').fadeOut('slow'); }, 5000);
});
</script>
@endpush