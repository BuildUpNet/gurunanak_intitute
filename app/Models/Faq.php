<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
    protected $fillable = [
    'page_name',
    'question',
    'answer',
    'status',
    'sort_order',
];
}
