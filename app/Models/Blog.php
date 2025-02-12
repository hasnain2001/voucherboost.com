<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Blog extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'slug',
        'category_image',
        'category',
        'content',
        'meta_title',
       'meta_description',
        'meta_keyword',
        'top'
    ];
}
