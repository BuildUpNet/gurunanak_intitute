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
    ];

    public function category()
    {
        return $this->belongsTo(GalleryCategory::class, 'gallery_category_id');
    }

    public function subCategory()
    {
        return $this->belongsTo(GallerySubCategory::class, 'gallery_sub_category_id');
    }
}