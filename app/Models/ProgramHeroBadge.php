<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProgramHeroBadge extends Model
{
    protected $fillable = ['program_detail_id', 'icon', 'text', 'sort_order'];

    public function programDetail()
    {
        return $this->belongsTo(ProgramDetail::class);
    }
}
