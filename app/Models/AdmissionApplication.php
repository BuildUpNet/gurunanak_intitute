<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdmissionApplication extends Model
{
    protected $fillable = [
        'candidate_name', 'course_name', 'gender', 'category', 'category_other',
        'dob', 'place_of_birth', 'aadhaar_no',
        'nationality', 'country_citizenship', 'permanent_address',
        'mobile', 'email', 'status',
    ];

    protected $casts = [
        'dob' => 'date',
    ];
}
