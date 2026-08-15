<?php

namespace App\Models\Admin;

use App\Models\Admin\BlogTag;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Blog extends Model
{
    protected $guarded = [];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'published_at' => 'datetime',
    ];

    /**
     * Get the category that this blog belongs to.
     *
     * @return BelongsTo
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(BlogCategory::class, 'category_id');
    }

    /**
     * Get the tags for this blog.
     *
     * @return BelongsToMany
     */
    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(BlogTag::class, 'blog_tag_blog', 'blog_id', 'tag_id');
    }

    /**
     * Get all comments for this blog.
     *
     * @return HasMany
     */
    public function comments(): HasMany
    {
        return $this->hasMany(BlogComment::class, 'blog_id');
    }

    /**
     * Get only approved comments for this blog.
     *
     * @return HasMany
     */
    public function approvedComments(): HasMany
    {
        return $this->hasMany(BlogComment::class, 'blog_id')->where('status', 'approved');
    }

    /**
     * Get the user who created this blog.
     *
     * @return BelongsTo
     */
    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * Get the user who last updated this blog.
     *
     * @return BelongsTo
     */
    public function updatedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    /**
     * Get the status badge HTML.
     *
     * @return string
     */
    public function getStatusBadgeAttribute(): string
    {
        $statuses = [
            'draft' => '<span class="badge bg-warning text-dark">Draft</span>',
            'published' => '<span class="badge bg-success">Published</span>',
            'archived' => '<span class="badge bg-secondary">Archived</span>',
        ];
        return $statuses[$this->status] ?? '<span class="badge bg-secondary">Unknown</span>';
    }

    /**
     * Get the human-readable robots label.
     *
     * @return string
     */
    public function getRobotsLabelAttribute(): string
    {
        $labels = [
            'index,follow' => 'Index, Follow',
            'index,nofollow' => 'Index, NoFollow',
            'noindex,follow' => 'NoIndex, Follow',
            'noindex,nofollow' => 'NoIndex, NoFollow',
        ];
        return $labels[$this->robots] ?? $this->robots;
    }

    /**
     * Get the excerpt for this blog.
     * If excerpt is not set, generate one from content.
     *
     * @return string
     */
    public function getExcerptAttribute(): string
    {
        if ($this->attributes['excerpt']) {
            return $this->attributes['excerpt'];
        }
        return Str::limit(strip_tags($this->content), 150);
    }

    /**
     * Get the full URL for the featured image.
     *
     * @return string|null
     */
    public function getFeaturedImageUrlAttribute(): ?string
    {
        if ($this->featured_image) {
            return asset('storage/' . $this->featured_image);
        }
        return null;
    }

    /**
     * Increment the view count for this blog.
     *
     * @return void
     */
    public function incrementViews(): void
    {
        $this->increment('views');
    }

    /**
     * Scope a query to only include published blogs.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopePublished($query)
    {
        return $query->where('status', 'published')
            ->whereNotNull('published_at')
            ->where('published_at', '<=', now());
    }
}
