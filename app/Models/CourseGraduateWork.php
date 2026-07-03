<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CourseGraduateWork extends Model
{
    protected $table = 'course_graduates_work';

    protected $fillable = [
        'course_id',
        'title',
    ];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}