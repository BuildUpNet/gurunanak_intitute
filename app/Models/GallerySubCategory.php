<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class GallerySubCategory extends Model
{
    protected $fillable = [
        'gallery_category_id',
        'title',
        'slug',
        'heading',
        'show_number',
        'number_label',
        'description',
        'event_date',
        'is_active',
    ];

    protected $casts = [
        'event_date' => 'date',
        'show_number' => 'boolean',
    ];

    // Max photos one sub category (event) can hold
    public const MAX_IMAGES = 8;

    // Slug words that would clash with gallery routes (/gallery/{cat}/page/2)
    private const RESERVED_SLUGS = ['page'];

    protected static function booted(): void
    {
        // Slug is made from the title automatically (unique inside its category)
        static::saving(function (GallerySubCategory $sub) {
            if (!$sub->slug || $sub->isDirty('title') || $sub->isDirty('gallery_category_id')) {
                $sub->slug = $sub->makeUniqueSlug();
            }
        });
    }

    public function makeUniqueSlug(): string
    {
        $base = Str::slug($this->title) ?: 'event';
        if (in_array($base, self::RESERVED_SLUGS, true)) {
            $base .= '-photos';
        }

        $slug = $base;
        $n = 2;
        while (static::where('gallery_category_id', $this->gallery_category_id)
            ->where('slug', $slug)
            ->when($this->exists, fn($q) => $q->where('id', '!=', $this->id))
            ->exists()) {
            $slug = $base . '-' . $n++;
        }

        return $slug;
    }

    /** Give a slug to rows saved before slugs existed (old/live data). */
    public static function fillMissingSlugs($subs): void
    {
        foreach ($subs as $sub) {
            if (!$sub->slug) {
                $sub->save();
            }
        }
    }

    /** Title shown on the gallery page: Display Title, else the sub category name. */
    public function displayTitle(): string
    {
        return $this->heading ?: $this->title;
    }

    public function category()
    {
        return $this->belongsTo(GalleryCategory::class, 'gallery_category_id');
    }

    public function images()
    {
        return $this->hasMany(GalleryImage::class, 'gallery_sub_category_id');
    }
}
