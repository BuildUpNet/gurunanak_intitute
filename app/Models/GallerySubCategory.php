<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GallerySubCategory extends Model
{
    protected $fillable = [
        'gallery_category_id',
        'title',
        'is_active',
    ];

    public function category()
    {
        return $this->belongsTo(GalleryCategory::class, 'gallery_category_id');
    }
     public function images()
    {
        return $this->hasMany(GalleryImage::class, 'gallery_sub_category_id');
    }
}
