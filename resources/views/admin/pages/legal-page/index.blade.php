@extends('admin.layouts.app')

@section('title', 'Legal Pages')

@section('content')
<div class="page-heading">
    <div class="page-heading-copy">
        <span class="page-icon"><i class="bi bi-file-earmark-text"></i></span>
        <div>
            <p class="eyebrow mb-1">Content Management</p>
            <h1 class="h3 mb-1">Legal Pages</h1>
            <p class="text-muted mb-0">Manage About, Privacy Policy, Terms & Conditions, Disclaimer, and Refund Policy.</p>
        </div>
    </div>
    <div class="heading-actions">
        <a class="btn btn-outline-secondary btn-sm" href="{{ route('admin.legal-page') }}">
            <i class="bi bi-arrow-clockwise"></i> Refresh
        </a>
    </div>
</div>

<div class="panel mt-3">
    <div class="panel-header">
        <div>
            <h2 class="h5 mb-1 section-title">
                <i class="bi bi-table"></i>
                <span>Legal Pages List</span>
            </h2>
            <p class="text-muted mb-0">Click edit to update page content.</p>
        </div>
        <div class="d-flex flex-wrap gap-2">
            <input class="form-control form-control-sm table-search" type="search"
                   placeholder="Search pages..." id="searchPages">
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
        <table class="table align-middle mb-0" id="legalPagesTable">
            <thead>
                <tr>
                    <th width="50">#</th>
                    <th>Page</th>
                    <th>Title</th>
                    <th>Last Updated</th>
                    <th class="text-end">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($pages as $page)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>
                            <div class="d-flex align-items-center gap-2">
                                <span class="badge bg-light text-dark">
                                    <i class="bi bi-file-earmark-text me-1"></i>
                                    {{ $page->type_label }}
                                </span>
                            </div>
                        </td>
                        <td>
                            <p class="fw-semibold mb-0">{{ $page->title }}</p>
                            <p class="text-muted small mb-0">
                                {{ Str::limit(strip_tags($page->description ?? ''), 60) ?: 'No content' }}
                            </p>
                        </td>
                        <td>
                            <span class="badge bg-light text-dark">
                                <i class="bi bi-clock me-1"></i>
                                {{ $page->updated_at->format('M d, Y H:i') }}
                            </span>
                        </td>
                        <td class="text-end">
                            <a href="{{ route('admin.legal-page.edit', $page->type) }}"
                               class="btn btn-light btn-sm" title="Edit Page">
                                <i class="bi bi-pencil"></i>
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center py-5">
                            <div class="empty-state">
                                <i class="bi bi-file-earmark-text display-4 text-muted d-block mb-3"></i>
                                <h5>No Legal Pages Found</h5>
                                <p class="text-muted">Run the seeder to create default legal pages.</p>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection

@push('scripts')
<script>
$(document).ready(function() {
    $('#searchPages').on('keyup', function() {
        const searchValue = $(this).val().toLowerCase();
        $('#legalPagesTable tbody tr').filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(searchValue) > -1);
        });
    });

    setTimeout(function() { $('.alert').fadeOut('slow'); }, 5000);
});
</script>
@endpush