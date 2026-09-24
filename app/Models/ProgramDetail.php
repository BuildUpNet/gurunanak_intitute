<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProgramDetail extends Model
{
    /** Shared hero background used when a program has no image of its own — never delete this file. */
    public const DEFAULT_HERO_IMAGE = 'images/programs/bg1.jpg';

    protected $fillable = [
        'program_category_id',
        'course_category_id',
        'slug', 'title', 'short_name', 'school_name', 'level', 'duration', 'locations',
        'hero_image', 'cta_image', 'quote',
        'overview_1', 'overview_2', 'overview_3', 'overview_4',
        'eligibility', 'status', 'sort_order',
    ];

    public function category()
    {
        return $this->belongsTo(ProgramCategory::class, 'program_category_id');
    }

    public function school()
    {
        return $this->belongsTo(CourseCategory::class, 'course_category_id');
    }

    public function opportunities()
    {
        return $this->hasMany(ProgramOpportunity::class)->orderBy('sort_order');
    }

    public function levels()
    {
        return $this->hasMany(ProgramLevel::class)->orderBy('sort_order');
    }

    public function heroBadges()
    {
        return $this->hasMany(ProgramHeroBadge::class)->orderBy('sort_order');
    }

    public function glanceItems()
    {
        return $this->hasMany(ProgramGlanceItem::class)->orderBy('sort_order');
    }

    public function careerRoles()
    {
        return $this->hasMany(ProgramCareerRole::class)->orderBy('sort_order');
    }

    public function graduatesWork()
    {
        return $this->hasMany(ProgramGraduateWork::class)->orderBy('sort_order');
    }

    public function faqs()
    {
        return $this->hasMany(ProgramFaq::class)->orderBy('sort_order');
    }

    public function heroImagePath(): string
    {
        return $this->hero_image ?: self::DEFAULT_HERO_IMAGE;
    }
}
