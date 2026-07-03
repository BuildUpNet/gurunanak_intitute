<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProgramCareerRole extends Model
{
    protected $fillable = ['program_detail_id', 'title', 'sort_order'];

    public function programDetail()
    {
        return $this->belongsTo(ProgramDetail::class);
    }
}
