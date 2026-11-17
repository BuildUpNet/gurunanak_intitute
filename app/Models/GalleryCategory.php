<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class GalleryCategory extends Model
{
    // Gallery page design per category
    public const STYLE_EVENTS = 'events'; // event blocks (title, date, mosaic)
    public const STYLE_GROUP = 'group';   // equal-height photo grid (batch group photos)

    public const STYLES = [
        self::STYLE_EVENTS => 'Events Layout (title, date & photo mosaic)',
        self::STYLE_GROUP => 'Group Photos Grid (equal size photo cards)',
    ];

    protected $fillable = [
        'title',
        'slug',
        'image',
        'short_description',
        'display_style',
        'sort_order',
        'is_active'
    ];

    // Slugs that would clash with other /gallery/... routes
    public const RESERVED_SLUGS = ['view'];

    /** Clean, lower-case, URL-safe slug (never a reserved word). */
    public static function cleanSlug(?string $slug, string $title): string
    {
        $slug = Str::slug($slug ?: $title) ?: 'album';

        return in_array($slug, self::RESERVED_SLUGS, true) ? $slug . '-gallery' : $slug;
    }

    /** Give a slug to rows saved before (empty or upper-case slugs). */
    public static function fillMissingSlugs($categories): void
    {
        foreach ($categories as $category) {
            $clean = self::cleanSlug($category->slug, $category->title);
            if ($category->slug !== $clean) {
                $base = $clean;
                $n = 2;
                while (static::where('slug', $clean)->where('id', '!=', $category->id)->exists()) {
                    $clean = $base . '-' . $n++;
                }
                $category->slug = $clean;
                $category->save();
            }
        }
    }

    public function isGroupStyle(): bool
    {
        return $this->display_style === self::STYLE_GROUP;
    }

    public function subCategories()
    {
        return $this->hasMany(GallerySubCategory::class, 'gallery_category_id');
    }

    public function images()
    {
        return $this->hasMany(GalleryImage::class, 'gallery_category_id');
    }
}
