<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Categories extends Model
{
    use HasFactory; 
    protected $fillable = [
        'title',
        'slug',
        'meta_tag',
        'meta_keyword',
        'meta_description',
        'status',
        'authentication',
        'category_image',
    ];
}
