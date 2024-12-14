<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;
    protected $table = "blogs";
    protected $fillable = [
        'blogcategory_id',
        'title',
        'image',
        'short_desc',
        'desc',
        'date',
        'status',
    ];
}
