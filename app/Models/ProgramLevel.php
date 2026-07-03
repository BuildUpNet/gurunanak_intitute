<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProgramLevel extends Model
{
    protected $fillable = [
        'program_detail_id',
        'program_category_id',
        'duration',
        'sort_order',
    ];

    public function programDetail()
    {
        return $this->belongsTo(ProgramDetail::class);
    }

    public function category()
    {
        return $this->belongsTo(ProgramCategory::class, 'program_category_id');
    }
}
