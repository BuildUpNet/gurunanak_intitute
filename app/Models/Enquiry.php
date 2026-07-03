<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Enquiry extends Model
{
    protected $fillable = [
        'name',
        'phone',
        'email',
        'course',
        'course_category_id',
        'course_id',
        'branch',
        'message',
    ];

    public function courseCategory()
    {
        return $this->belongsTo(CourseCategory::class, 'course_category_id');
    }

    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id');
    }
}