<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdmissionApplication extends Model
{
    protected $fillable = [
        'candidate_name', 'course_name', 'gender', 'category', 'category_other',
        'dob', 'place_of_birth', 'aadhaar_no',
        'father_name', 'father_occupation', 'father_mobile',
        'mother_name', 'mother_occupation', 'mother_mobile',
        'nationality', 'country_citizenship', 'permanent_address',
        'mobile', 'email',
        'education', 'heard_from', 'heard_from_other', 'status',
    ];

    protected $casts = [
        'education'  => 'array',
        'heard_from' => 'array',
        'dob'        => 'date',
    ];
}
