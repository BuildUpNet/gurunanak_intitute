<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GalleryImage extends Model
{
    protected $fillable = [
        'gallery_category_id',
        'gallery_sub_category_id',
        'title',
        'description',
        'image_alt',
        'image',
        'is_active',
        'sort_order',
    ];

    protected $casts = [
        'sort_order' => 'integer',
    ];

    /**
     * Admin order first (1, 2, 3 … — 1 is the big photo of its event),
     * photos without an order (0) after them, newest first.
     */
    public function scopeDisplayOrder($query)
    {
        return $query->orderByRaw('sort_order = 0')
            ->orderBy('sort_order')
            ->orderByDesc('created_at')
            ->orderByDesc('id');
    }

    public function category()
    {
        return $this->belongsTo(GalleryCategory::class, 'gallery_category_id');
    }

    public function subCategory()
    {
        return $this->belongsTo(GallerySubCategory::class, 'gallery_sub_category_id');
    }
}