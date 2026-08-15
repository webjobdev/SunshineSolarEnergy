<?php

namespace App\Models\Admin;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class WebsiteConfiguration extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'config_options' => 'array',
        'is_required' => 'boolean',
        'is_editable' => 'boolean',
    ];

    /**
     * Get the user who created this configuration.
     *
     * @return BelongsTo
     */
    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * Get the user who last updated this configuration.
     *
     * @return BelongsTo
     */
    public function updatedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    /**
     * Get the typed value based on config_type.
     *
     * @return mixed
     */
    public function getTypedValueAttribute(): mixed
    {
        return match ($this->config_type) {
            'boolean' => filter_var($this->config_value, FILTER_VALIDATE_BOOLEAN),
            'number' => (float) $this->config_value,
            'json' => json_decode($this->config_value, true),
            'image', 'file' => $this->config_value ? asset('storage/' . $this->config_value) : null,
            default => $this->config_value,
        };
    }

    /**
     * Get image URL if config_type is image.
     *
     * @return string|null
     */
    public function getImageUrlAttribute(): ?string
    {
        if (!in_array($this->config_type, ['image', 'file']) || empty($this->config_value)) {
            return null;
        }
        return asset('storage/' . $this->config_value);
    }

    /**
     * Scope a query to get configurations by group.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param string $group
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeGroup($query, string $group)
    {
        return $query->where('config_group', $group);
    }

    /**
     * Scope a query to get editable configurations.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeEditable($query)
    {
        return $query->where('is_editable', true);
    }

    /**
     * Scope a query to get configurations by type.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param string $type
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeType($query, string $type)
    {
        return $query->where('config_type', $type);
    }
}