<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProgramGlanceItem extends Model
{
    protected $fillable = ['program_detail_id', 'degree', 'duration', 'eligibility', 'sort_order'];

    public function programDetail()
    {
        return $this->belongsTo(ProgramDetail::class);
    }
}
