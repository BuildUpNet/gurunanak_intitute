<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProgramOpportunity extends Model
{
    protected $fillable = ['program_detail_id', 'icon', 'title', 'sort_order'];

    public function program()
    {
        return $this->belongsTo(ProgramDetail::class, 'program_detail_id');
    }
}
