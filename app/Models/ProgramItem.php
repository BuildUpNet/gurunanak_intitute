<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProgramItem extends Model
{
    protected $fillable = [
        'program_category_id',
        'title',
        'url',
        'sort_order',
        'status',
    ];

    protected $casts = [
        'status' => 'boolean',
    ];

    public function programCategory()
    {
        return $this->belongsTo(ProgramCategory::class);
    }
}
