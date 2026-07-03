<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GalleryCategory extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'image',
        'short_description',
        'sort_order',
        'is_active'
    ];
    public function subCategories()
    {
        return $this->hasMany(GallerySubCategory::class, 'gallery_category_id');
    }
    public function images()
{
    return $this->hasMany(GalleryImage::class, 'gallery_category_id');
}
}
