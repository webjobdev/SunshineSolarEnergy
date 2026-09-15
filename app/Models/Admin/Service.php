<?php

namespace App\Models\Admin;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class Service extends Model
{
    /**
     * Guard all attributes.
     *
     * @var array<int, string>
     */
    protected $guarded = [];

    /**
     * Get the user who created this service.
     *
     * @return BelongsTo
     */
    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * Get the user who last updated this service.
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
            'active' => '<span class="badge bg-success">Active</span>',
            'inactive' => '<span class="badge bg-danger">Inactive</span>',
        ];
        return $statuses[$this->status] ?? '<span class="badge bg-secondary">Unknown</span>';
    }

    /**
     * Get the full URL for the thumbnail.
     *
     * @return string|null
     */
    public function getThumbnailUrlAttribute(): ?string
    {
        if ($this->thumbnail) {
            return asset('storage/' . $this->thumbnail);
        }
        return null;
    }

    /**
     * Get the excerpt for this service.
     *
     * @return string
     */
    public function getExcerptAttribute(): string
    {
        if ($this->short_description) {
            return $this->short_description;
        }
        return Str::limit(strip_tags($this->description), 150);
    }

    /**
     * Scope a query to only include active services.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }
}