<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProgramGraduateWork extends Model
{
    protected $table = 'program_graduates_work';

    protected $fillable = ['program_detail_id', 'title', 'sort_order'];

    public function programDetail()
    {
        return $this->belongsTo(ProgramDetail::class);
    }
}
