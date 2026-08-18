<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Faq extends Model
{
    protected $fillable = [
        'service_id',
        'question',
        'answer',
        'order',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    // ─── Relationships ───────────────────────────────────────────────────

    /**
     * FAQ bisa terikat ke layanan tertentu, atau null = FAQ umum.
     */
    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class);
    }

    // ─── Scopes ──────────────────────────────────────────────────────────

    public function scopeActive($query)
    {
        return $query->where('is_active', true)->orderBy('order');
    }

    public function scopeGeneral($query)
    {
        return $query->whereNull('service_id')->where('is_active', true);
    }
}
