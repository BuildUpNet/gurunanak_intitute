<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * One section on the Awards & Recognition page: its own heading + description + images (awards).
 */
class AwardSection extends Model
{
    // Page-level heading lives in site_settings (editable from admin/awards)
    public const PAGE_TITLE_KEY = 'awards_page_title';
    public const PAGE_DESCRIPTION_KEY = 'awards_page_description';
    public const PAGE_EYEBROW_KEY = 'awards_page_eyebrow';
    public const DEFAULT_PAGE_TITLE = 'Awards & Recognitions';
    public const DEFAULT_PAGE_EYEBROW = 'Est. 1991 · UGC Recognised · Patiala & Karnal';
    public const DEFAULT_PAGE_DESCRIPTION = "Honours that celebrate GNIMT's three decades of excellence in healthcare education and skill development.";

    /** Small line above the title. Default until admin saves it; saved empty = hidden. */
    public static function pageEyebrow(): string
    {
        return (string) SiteSetting::get(self::PAGE_EYEBROW_KEY, self::DEFAULT_PAGE_EYEBROW);
    }

    public static function pageTitle(): string
    {
        return SiteSetting::get(self::PAGE_TITLE_KEY) ?: self::DEFAULT_PAGE_TITLE;
    }

    public static function pageDescription(): string
    {
        // Default until admin saves it; saved empty = hidden
        return (string) SiteSetting::get(self::PAGE_DESCRIPTION_KEY, self::DEFAULT_PAGE_DESCRIPTION);
    }

    protected $fillable = [
        'title',
        'description',
        'sort_order',
        'status',
    ];

    public function awards()
    {
        return $this->hasMany(Award::class)->orderBy('sort_order')->orderBy('id');
    }

    public function activeAwards()
    {
        return $this->awards()->where('status', 1)->whereNotNull('image');
    }

    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order')->orderBy('id');
    }
}
