<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $fillable = [
        'course_category_id',
        'title',
        'slug',
        'short_description',
        'quote',
        'duration_title_one',
        'duration_one',

        'duration_title_two',
        'duration_two',

        'duration_title_three',
        'duration_three',
        'eligibility',
        'recognition',
        'placement_rate',
        'program_overview',
        'about_course',
        'status',
    ];

    public function category()
    {
        return $this->belongsTo(CourseCategory::class, 'course_category_id');
    }

    public function employmentOpportunities()
    {
        return $this->hasMany(CourseEmploymentOpportunity::class);
    }

    public function careerRoles()
    {
        return $this->hasMany(CourseCareerRole::class);
    }

    public function graduatesWork()
    {
        return $this->hasMany(CourseGraduateWork::class);
    }

    public function faqs()
    {
        return $this->hasMany(CourseFaq::class);
    }
}
