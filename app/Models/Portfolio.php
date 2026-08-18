<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Portfolio extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'category',
        'client_name',
        'location',
        'year_completed',
        'project_value',
        'thumbnail',
        'short_description',
        'content',
        'is_featured',
        'is_active',
        'order',
        'meta_title',
        'meta_desc',
        'og_image',
    ];

    protected $casts = [
        'is_featured'   => 'boolean',
        'is_active'     => 'boolean',
        'project_value' => 'decimal:2',
    ];

    // ─── Relationships ───────────────────────────────────────────────────

    /**
     * Setiap proyek bisa punya banyak gambar galeri.
     */
    public function images(): HasMany
    {
        return $this->hasMany(PortfolioImage::class)->orderBy('order');
    }

    // ─── Accessors / Mutators ────────────────────────────────────────────

    protected static function booted(): void
    {
        static::creating(function (self $portfolio) {
            if (empty($portfolio->slug)) {
                $portfolio->slug = Str::slug($portfolio->title);
            }
        });
    }

    // ─── Scopes ──────────────────────────────────────────────────────────

    public function scopeActive($query)
    {
        return $query->where('is_active', true)->orderBy('order');
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true)->where('is_active', true);
    }

    public function scopeByCategory($query, string $category)
    {
        return $query->where('category', $category);
    }
}
