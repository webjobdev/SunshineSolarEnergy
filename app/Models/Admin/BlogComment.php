<?php

namespace App\Models\Admin;

use App\Models\Admin\Blog;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class BlogComment extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [];

    /**
     * Get the blog that this comment belongs to.
     *
     * @return BelongsTo
     */
    public function blog(): BelongsTo
    {
        return $this->belongsTo(Blog::class, 'blog_id');
    }

    /**
     * Get the user who created this comment.
     *
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Get the parent comment for this reply.
     *
     * @return BelongsTo
     */
    public function parent(): BelongsTo
    {
        return $this->belongsTo(BlogComment::class, 'parent_id');
    }

    /**
     * Get all replies for this comment.
     *
     * @return HasMany
     */
    public function replies(): HasMany
    {
        return $this->hasMany(BlogComment::class, 'parent_id');
    }

    /**
     * Get the user who created this comment.
     *
     * @return BelongsTo
     */
    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * Get the user who last updated this comment.
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
            'pending' => '<span class="badge bg-warning text-dark">Pending</span>',
            'approved' => '<span class="badge bg-success">Approved</span>',
            'rejected' => '<span class="badge bg-danger">Rejected</span>',
        ];
        return $statuses[$this->status] ?? '<span class="badge bg-secondary">Unknown</span>';
    }

    /**
     * Scope a query to only include approved comments.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeApproved($query)
    {
        return $query->where('status', 'approved');
    }

    /**
     * Scope a query to only include pending comments.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }
}