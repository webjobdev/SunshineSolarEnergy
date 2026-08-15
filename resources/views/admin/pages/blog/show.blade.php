@extends('admin.layouts.app')

@section('title', $blog->title)

@section('content')
<div class="page-heading">
    <div class="page-heading-copy">
        <span class="page-icon"><i class="bi bi-eye"></i></span>
        <div>
            <p class="eyebrow mb-1">Content Management</p>
            <h1 class="h3 mb-1">{{ $blog->title }}</h1>
            <p class="text-muted mb-0">View blog post details.</p>
        </div>
    </div>
    <div class="heading-actions">
        <a class="btn btn-outline-secondary btn-sm" href="{{ route('admin.blog') }}">
            <i class="bi bi-arrow-left"></i> Back
        </a>
        <a class="btn btn-primary btn-sm" href="{{ route('admin.blog.edit', $blog->id) }}">
            <i class="bi bi-pencil"></i> Edit
        </a>
        {{-- <a class="btn btn-success btn-sm" href="{{ route('admin.page.show', $blog->slug) }}" target="_blank">
            <i class="bi bi-eye"></i> View
        </a> --}}
    </div>
</div>

<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-md-8">
                @if($blog->featured_image)
                    <div class="mb-3">
                        <img src="{{ $blog->featured_image_url }}" 
                             alt="{{ $blog->title }}" 
                             class="img-fluid rounded" 
                             style="max-height: 300px; width: 100%; object-fit: cover;">
                    </div>
                @endif

                <div class="blog-meta mb-3">
                    <span class="badge bg-light text-dark">{{ $blog->category->name ?? 'Uncategorized' }}</span>
                    @foreach($blog->tags as $tag)
                        <span class="badge bg-primary">{{ $tag->name }}</span>
                    @endforeach
                    {!! $blog->status_badge !!}
                </div>

                @if($blog->excerpt)
                    <div class="alert alert-info">
                        <strong>Excerpt:</strong> {{ $blog->excerpt }}
                    </div>
                @endif

                <div class="blog-content">
                    {!! $blog->content !!}
                </div>
            </div>

            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">Blog Information</h5>
                    </div>
                    <div class="card-body">
                        <p><strong>Status:</strong> {!! $blog->status_badge !!}</p>
                        <p><strong>Category:</strong> {{ $blog->category->name ?? 'Uncategorized' }}</p>
                        <p><strong>Views:</strong> {{ number_format($blog->views) }}</p>
                        <p><strong>Published:</strong> {{ $blog->published_at ? $blog->published_at->format('M d, Y') : 'Not published' }}</p>
                        <p><strong>Created:</strong> {{ $blog->created_at->format('M d, Y H:i') }}</p>
                        <p><strong>Updated:</strong> {{ $blog->updated_at->format('M d, Y H:i') }}</p>
                        <p><strong>Created By:</strong> {{ $blog->createdBy->name ?? 'System' }}</p>
                    </div>
                </div>

                <div class="card mt-3">
                    <div class="card-header">
                        <h5 class="mb-0">SEO Information</h5>
                    </div>
                    <div class="card-body">
                        <p><strong>Meta Title:</strong> {{ $blog->meta_title ?? 'Not set' }}</p>
                        <p><strong>Meta Description:</strong> {{ $blog->meta_description ?? 'Not set' }}</p>
                        <p><strong>Focus Keyword:</strong> {{ $blog->focus_keyword ?? 'Not set' }}</p>
                        <p><strong>Canonical URL:</strong> {{ $blog->canonical_url ?? 'Not set' }}</p>
                        <p><strong>Robots:</strong> {{ $blog->robots_label }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .blog-content {
        font-size: 16px;
        line-height: 1.8;
    }
    
    .blog-content h1, .blog-content h2, .blog-content h3 {
        margin-top: 1.5rem;
        margin-bottom: 0.75rem;
    }
    
    .blog-content img {
        max-width: 100%;
        height: auto;
    }
</style>
@endpush