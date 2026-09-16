<?php

namespace App\Models\Admin;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LegalPage extends Model
{
    /**
     * Guard all attributes.
     *
     * @var array<int, string>
     */
    protected $guarded = [];

    /**
     * All supported legal page types with their labels.
     *
     * @var array<string, string>
     */
    public const TYPES = [
        'about' => 'About Us',
        'privacy-policy' => 'Privacy Policy',
        'terms-conditions' => 'Terms & Conditions',
        'disclaimer' => 'Disclaimer',
        'refund-cancellation-policy' => 'Refund & Cancellation Policy',
    ];

    /**
     * Get the user who created this page.
     *
     * @return BelongsTo
     */
    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * Get the user who last updated this page.
     *
     * @return BelongsTo
     */
    public function updatedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    /**
     * Get the human-readable label for this page type.
     *
     * @return string
     */
    public function getTypeLabelAttribute(): string
    {
        return self::TYPES[$this->type] ?? $this->type;
    }
}