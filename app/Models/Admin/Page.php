<?php

namespace App\Models\Admin;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Page extends Model
{
    /**
     * Guard all attributes.
     *
     * @var array<int, string>
     */
    protected $guarded = [];

    /**
     * Get page creator.
     *
     * @return BelongsTo
     */
    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * Get page updater.
     *
     * @return BelongsTo
     */
    public function updatedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    /**
     * Get status badge HTML.
     *
     * @return string
     */
    public function getStatusBadgeAttribute(): string
    {
        if ($this->status === 'active') {
            return '<span class="badge bg-success">Active</span>';
        }
        return '<span class="badge bg-danger">Inactive</span>';
    }

    /**
     * Get robots label.
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
}