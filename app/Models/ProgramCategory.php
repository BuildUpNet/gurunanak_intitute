<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProgramCategory extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'icon',
        'image',
        'sort_order',
        'status',
    ];

    protected $casts = [
        'status' => 'boolean',
    ];

    public function programDetails()
    {
        return $this->hasMany(ProgramDetail::class)->orderBy('sort_order');
    }

    public function programItems()
    {
        return $this->hasMany(ProgramItem::class);
    }

    public function programLevels()
    {
        return $this->hasMany(ProgramLevel::class)->with('programDetail')->orderBy('sort_order');
    }
}
