<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Award extends Model
{
    protected $fillable = [
        'title',
        'subtitle',
        'description',
        'image',
        'sort_order',
        'status',
    ];

    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }
}
