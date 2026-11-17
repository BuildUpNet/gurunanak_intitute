<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * One row = one image inside an AwardSection on the Awards & Recognition page.
 */
class Award extends Model
{
    protected $fillable = [
        'award_section_id',
        'title',
        'subtitle',
        'description',
        'image',
        'sort_order',
        'status',
    ];

    public function section()
    {
        return $this->belongsTo(AwardSection::class, 'award_section_id');
    }

    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }
}
