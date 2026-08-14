<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AboutImage extends Model
{
    protected $fillable = [
        'image',
        'alt_text',
        'position',
        'status',
        'sort_order',
    ];

    /**
     * Scope to get only active images.
     */
    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }
}
