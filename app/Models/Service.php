<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Service extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'icon',
        'thumbnail',
        'short_description',
        'content',
        'order',
        'is_active',
        'meta_title',
        'meta_desc',
        'og_image',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    // ─── Relationships ───────────────────────────────────────────────────

    /**
     * Setiap layanan bisa punya banyak FAQ.
     */
    public function faqs(): HasMany
    {
        return $this->hasMany(Faq::class)->orderBy('order');
    }

    // ─── Accessors / Mutators ────────────────────────────────────────────

    /**
     * Auto-generate slug dari title jika tidak diisi manual.
     */
    protected static function booted(): void
    {
        static::creating(function (self $service) {
            if (empty($service->slug)) {
                $service->slug = Str::slug($service->title);
            }
        });
    }

    // ─── Scopes ──────────────────────────────────────────────────────────

    /**
     * Hanya tampilkan layanan yang aktif, diurutkan berdasarkan kolom order.
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true)->orderBy('order');
    }
}
