<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProgramFaq extends Model
{
    protected $fillable = ['program_detail_id', 'question', 'answer', 'sort_order'];

    public function programDetail()
    {
        return $this->belongsTo(ProgramDetail::class);
    }
}
