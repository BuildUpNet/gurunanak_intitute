<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CourseCategory extends Model
{
    protected $fillable = [
        'icon',
        'title',
        'slug',
        'status',
        'sort_order'
    ];

    public function courses()
    {
        return $this->hasMany(Course::class);
    }

    public function programDetails()
    {
        return $this->hasMany(ProgramDetail::class, 'course_category_id')->orderBy('sort_order');
    }
}