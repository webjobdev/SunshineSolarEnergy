@extends('admin.layouts.app')

@section('title', 'Dashboard')

@section('content')
    <div class="page-heading">
        <div class="page-heading-copy">
            <span class="page-icon"><i class="bi bi-speedometer2" aria-hidden="true"></i></span>
            <div>
                <p class="eyebrow mb-1">Overview</p>
                <h1 class="h3 mb-1">Dashboard</h1>
                <p class="text-muted mb-0">Welcome back, {{ auth()->user()->name }}! Here's what's happening with your
                    website.</p>
            </div>
        </div>
        <div class="heading-actions">
            <span class="badge bg-success">
                <i class="bi bi-check-circle-fill me-1"></i>
                System Running
            </span>
        </div>
    </div>

    {{-- ============================================== --}}
    {{-- Website Information Cards --}}
    {{-- ============================================== --}}
    <section class="row g-3 mt-1" aria-label="Website summary">

        {{-- Website Name --}}
        <div class="col-12 col-sm-6 col-xl-3">
            <article class="metric-card metric-primary">
                <div class="metric-top">
                    <span class="metric-label">Website Name</span>
                    <span class="metric-icon"><i class="bi bi-globe2" aria-hidden="true"></i></span>
                </div>
                <div class="metric-value" style="font-size: 1.1rem;">
                    {{ configSetting('web_name', 'Not Set') }}
                </div>
                <div class="metric-meta">
                    <span class="text-muted">{{ configSetting('web_tagline', '') }}</span>
                </div>
            </article>
        </div>

        {{-- Contact Email --}}
        <div class="col-12 col-sm-6 col-xl-3">
            <article class="metric-card metric-success">
                <div class="metric-top">
                    <span class="metric-label">Contact Email</span>
                    <span class="metric-icon"><i class="bi bi-envelope" aria-hidden="true"></i></span>
                </div>
                <div class="metric-value" style="font-size: 1rem;">
                    {{ configSetting('contact_email', 'Not Set') }}
                </div>
                <div class="metric-meta">
                    <span class="text-success">
                        <i class="bi bi-telephone me-1"></i>
                        {{ configSetting('contact_phone', 'No phone') }}
                    </span>
                </div>
            </article>
        </div>

        {{-- Social Media --}}
        <div class="col-12 col-sm-6 col-xl-3">
            <article class="metric-card metric-info">
                <div class="metric-top">
                    <span class="metric-label">Social Media</span>
                    <span class="metric-icon"><i class="bi bi-share" aria-hidden="true"></i></span>
                </div>
                <div class="metric-value">{{ $socialCount }}</div>
                <div class="metric-meta">
                    <span class="text-info">Active social links</span>
                </div>
            </article>
        </div>

        {{-- System Status --}}
        <div class="col-12 col-sm-6 col-xl-3">
            <article class="metric-card metric-warning">
                <div class="metric-top">
                    <span class="metric-label">System Status</span>
                    <span class="metric-icon"><i class="bi bi-gear" aria-hidden="true"></i></span>
                </div>
                <div class="metric-value" style="font-size: 1rem;">
                    @if(configSetting('system_maintenance', false))
                        <span class="text-danger">Maintenance Mode</span>
                    @else
                        <span class="text-success">Active</span>
                    @endif
                </div>
                <div class="metric-meta">
                    <span class="text-muted">
                        @if(configSetting('system_maintenance', false))
                            <i class="bi bi-exclamation-triangle text-danger"></i> Site is down
                        @else
                            <i class="bi bi-check-circle text-success"></i> All systems normal
                        @endif
                    </span>
                </div>
            </article>
        </div>
    </section>

    {{-- ============================================== --}}
    {{-- Content Stats --}}
    {{-- ============================================== --}}
    <section class="row g-3 mt-2">

        {{-- Products --}}
        <div class="col-12 col-md-6 col-xl-3">
            <div class="stat-card">
                <div class="stat-icon bg-primary bg-opacity-10 text-primary">
                    <i class="bi bi-box-seam"></i>
                </div>
                <div class="stat-info">
                    <h3 class="stat-number">{{ $totalProducts }}</h3>
                    <p class="stat-label">Total Products</p>
                    <small class="text-muted">
                        <span class="text-success">{{ $activeProducts }}</span> active,
                        <span class="text-danger">{{ $inactiveProducts }}</span> inactive
                    </small>
                </div>
            </div>
        </div>

        {{-- Services --}}
        <div class="col-12 col-md-6 col-xl-3">
            <div class="stat-card">
                <div class="stat-icon bg-success bg-opacity-10 text-success">
                    <i class="bi bi-gear-wide-connected"></i>
                </div>
                <div class="stat-info">
                    <h3 class="stat-number">{{ $totalServices }}</h3>
                    <p class="stat-label">Total Services</p>
                    <small class="text-muted">
                        <span class="text-success">{{ $activeServices }}</span> active
                    </small>
                </div>
            </div>
        </div>

        {{-- Reviews --}}
        <div class="col-12 col-md-6 col-xl-3">
            <div class="stat-card">
                <div class="stat-icon bg-warning bg-opacity-10 text-warning">
                    <i class="bi bi-star"></i>
                </div>
                <div class="stat-info">
                    <h3 class="stat-number">{{ $totalReviews }}</h3>
                    <p class="stat-label">Customer Reviews</p>
                    <small class="text-muted">
                        <span class="text-success">{{ $activeReviews }}</span> active
                    </small>
                </div>
            </div>
        </div>

        {{-- Brands / Categories --}}
        <div class="col-12 col-md-6 col-xl-3">
            <div class="stat-card">
                <div class="stat-icon bg-info bg-opacity-10 text-info">
                    <i class="bi bi-tags"></i>
                </div>
                <div class="stat-info">
                    <h3 class="stat-number">{{ $totalBrands }} / {{ $totalCategories }}</h3>
                    <p class="stat-label">Brands / Categories</p>
                    <small class="text-muted">
                        <span class="text-info">{{ $activeBrands }}</span> brands,
                        <span class="text-primary">{{ $activeCategories }}</span> categories
                    </small>
                </div>
            </div>
        </div>
    </section>

    {{-- ============================================== --}}
    {{-- Recent Products & Quick Actions --}}
    {{-- ============================================== --}}
    <section class="row g-3 mt-2">

        {{-- Recent Products --}}
        <div class="col-12 col-xl-7">
            <div class="panel">
                <div class="panel-header">
                    <div>
                        <h2 class="h5 mb-1 section-title">
                            <i class="bi bi-clock-history"></i>
                            <span>Recent Products</span>
                        </h2>
                        <p class="text-muted mb-0">Latest products added to your store.</p>
                    </div>
                    <a href="{{ route('admin.product') }}" class="btn btn-primary btn-sm">
                        View All <i class="bi bi-arrow-right"></i>
                    </a>
                </div>
                <div class="table-responsive">
                    <table class="table align-middle mb-0">
                        <thead>
                            <tr>
                                <th>Product</th>
                                <th>Category</th>
                                <th>Status</th>
                                <th class="text-end">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recentProducts as $product)
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center gap-2">
                                            @if($product->thumbnail_url)
                                                <img src="{{ $product->thumbnail_url }}" width="40" height="40" class="rounded"
                                                    alt="{{ $product->name }}">
                                            @else
                                                <div class="d-flex align-items-center justify-content-center bg-light rounded"
                                                    style="width: 40px; height: 40px;">
                                                    <i class="bi bi-box-seam text-muted"></i>
                                                </div>
                                            @endif
                                            <div>
                                                <p class="fw-semibold mb-0 small">{{ Str::limit($product->name, 30) }}</p>
                                                <small class="text-muted">{{ $product->brand->name ?? 'No brand' }}</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <small class="text-muted">{{ $product->category->name ?? 'Uncategorized' }}</small>
                                    </td>
                                    <td>{!! $product->status_badge !!}</td>
                                    <td class="text-end">
                                        <a href="{{ route('admin.product.edit', $product->id) }}" class="btn btn-light btn-sm"
                                            title="Edit">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center py-3 text-muted">
                                        No products yet.
                                        <a href="{{ route('admin.product.create') }}">Add your first product</a>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        {{-- Quick Actions & Website Config --}}
        <div class="col-12 col-xl-5">
            {{-- Quick Actions --}}
            <div class="panel mb-3">
                <div class="panel-header">
                    <h2 class="h5 mb-1 section-title">
                        <i class="bi bi-lightning"></i>
                        <span>Quick Actions</span>
                    </h2>
                </div>
                <div class="quick-actions-grid">
                    <a href="{{ route('admin.product.create') }}" class="quick-action-item">
                        <i class="bi bi-box-seam text-primary"></i>
                        <span>New Product</span>
                    </a>
                    <a href="{{ route('admin.service.create') }}" class="quick-action-item">
                        <i class="bi bi-gear-wide-connected text-success"></i>
                        <span>New Service</span>
                    </a>
                    <a href="{{ route('admin.customer-review.create') }}" class="quick-action-item">
                        <i class="bi bi-star text-warning"></i>
                        <span>New Review</span>
                    </a>
                    <a href="{{ route('admin.config', ['group' => 'general']) }}" class="quick-action-item">
                        <i class="bi bi-gear text-info"></i>
                        <span>Settings</span>
                    </a>
                </div>
            </div>

            {{-- Website Configuration Summary --}}
            <div class="panel">
                <div class="panel-header">
                    <h2 class="h5 mb-1 section-title">
                        <i class="bi bi-gear-wide-connected"></i>
                        <span>Website Configuration</span>
                    </h2>
                    <a href="{{ route('admin.config') }}" class="btn btn-outline-secondary btn-sm">
                        Manage <i class="bi bi-arrow-right"></i>
                    </a>
                </div>
                <div class="config-summary">
                    <div class="config-item">
                        <span class="config-label">Website Name</span>
                        <span class="config-value">{{ configSetting('web_name', 'Not Set') }}</span>
                    </div>
                    <div class="config-item">
                        <span class="config-label">Logo</span>
                        <span class="config-value">
                            @if(configImage('web_logo'))
                                <i class="bi bi-check-circle text-success"></i> Uploaded
                            @else
                                <span class="text-muted">Not uploaded</span>
                            @endif
                        </span>
                    </div>
                    <div class="config-item">
                        <span class="config-label">Favicon</span>
                        <span class="config-value">
                            @if(configImage('web_favicon'))
                                <i class="bi bi-check-circle text-success"></i> Uploaded
                            @else
                                <span class="text-muted">Not uploaded</span>
                            @endif
                        </span>
                    </div>
                    <div class="config-item">
                        <span class="config-label">Contact Email</span>
                        <span class="config-value">{{ configSetting('contact_email', 'Not Set') }}</span>
                    </div>
                    <div class="config-item">
                        <span class="config-label">Phone</span>
                        <span class="config-value">{{ configSetting('contact_phone', 'Not Set') }}</span>
                    </div>
                    <div class="config-item">
                        <span class="config-label">WhatsApp</span>
                        <span class="config-value">
                            @if(configSetting('whatsapp_number'))
                                <i class="bi bi-check-circle text-success"></i> Set
                            @else
                                <span class="text-muted">Not Set</span>
                            @endif
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('styles')
    <style>
        /* Metric Cards */
        .metric-card {
            background: #fff;
            border-radius: 0.5rem;
            padding: 1.25rem;
            border-left: 4px solid;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.06);
            height: 100%;
        }

        .metric-primary {
            border-left-color: #0d6efd;
        }

        .metric-success {
            border-left-color: #198754;
        }

        .metric-warning {
            border-left-color: #ffc107;
        }

        .metric-info {
            border-left-color: #0dcaf0;
        }

        .metric-danger {
            border-left-color: #dc3545;
        }

        .metric-top {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 0.5rem;
        }

        .metric-label {
            font-size: 0.875rem;
            color: #6c757d;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .metric-icon {
            font-size: 1.25rem;
            color: #6c757d;
            opacity: 0.7;
        }

        .metric-value {
            font-size: 1.75rem;
            font-weight: 700;
            color: #212529;
            line-height: 1.2;
        }

        .metric-meta {
            font-size: 0.875rem;
            color: #6c757d;
            margin-top: 0.25rem;
        }

        /* Stat Cards */
        .stat-card {
            background: #fff;
            border-radius: 0.5rem;
            padding: 1.25rem;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.06);
            display: flex;
            align-items: center;
            gap: 1rem;
            height: 100%;
        }

        .stat-icon {
            width: 50px;
            height: 50px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            flex-shrink: 0;
        }

        .stat-info {
            flex: 1;
        }

        .stat-number {
            font-size: 1.5rem;
            font-weight: 700;
            color: #212529;
            margin: 0;
        }

        .stat-label {
            font-size: 0.875rem;
            color: #6c757d;
            margin: 0;
        }

        .stat-info small {
            font-size: 0.75rem;
        }

        /* Panel */
        .panel {
            background: #fff;
            border-radius: 0.5rem;
            padding: 1.25rem;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.06);
        }

        .panel-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 1rem;
            margin-bottom: 1rem;
        }

        .section-title {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-weight: 600;
            font-size: 1rem;
        }

        .section-title i {
            color: #0d6efd;
        }

        /* Quick Actions */
        .quick-actions-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 0.75rem;
        }

        .quick-action-item {
            background: #f8f9fa;
            border-radius: 0.5rem;
            padding: 0.75rem;
            text-align: center;
            text-decoration: none;
            color: #212529;
            transition: all 0.3s ease;
            border: 1px solid #e9ecef;
        }

        .quick-action-item:hover {
            background: #e9ecef;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        }

        .quick-action-item i {
            font-size: 1.5rem;
            display: block;
            margin-bottom: 0.25rem;
        }

        .quick-action-item span {
            font-size: 0.8rem;
            font-weight: 500;
        }

        /* Config Summary */
        .config-summary {
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
        }

        .config-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0.5rem 0;
            border-bottom: 1px solid #f1f3f5;
        }

        .config-item:last-child {
            border-bottom: none;
        }

        .config-label {
            font-size: 0.85rem;
            color: #6c757d;
        }

        .config-value {
            font-size: 0.85rem;
            font-weight: 500;
            color: #212529;
            text-align: right;
            max-width: 60%;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        /* Page Heading */
        .page-heading {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            flex-wrap: wrap;
            gap: 1rem;
            margin-bottom: 1.5rem;
        }

        .page-heading-copy {
            display: flex;
            align-items: flex-start;
            gap: 1rem;
        }

        .page-icon {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 48px;
            height: 48px;
            background: var(--bs-primary-bg-subtle, #e7f1ff);
            border-radius: 10px;
            color: var(--bs-primary, #0d6efd);
            font-size: 1.5rem;
        }

        .eyebrow {
            text-transform: uppercase;
            font-size: 0.75rem;
            font-weight: 600;
            letter-spacing: 0.5px;
            color: var(--bs-secondary-color, #6c757d);
        }

        .heading-actions {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            padding-top: 0.5rem;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .quick-actions-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .stat-card {
                padding: 1rem;
            }

            .stat-number {
                font-size: 1.25rem;
            }

            .metric-value {
                font-size: 1.25rem;
            }

            .panel-header {
                flex-direction: column;
                align-items: flex-start;
            }

            .page-heading {
                flex-direction: column;
            }

            .heading-actions {
                width: 100%;
            }
        }
    </style>
@endpush