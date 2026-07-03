<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactEnquiry extends Model
{
    protected $fillable = [
        'name',
        'phone',
        'email',
        'subject',
        'branch',
        'course_category_id',
        'course_id',
        'course',
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
