<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'tag',
        'excerpt',
        'content',
        'date',
        'image',
        'link',
        'sort_order',
        'status',
    ];

    protected $casts = [
        'date' => 'date',
    ];
}
