<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Stores extends Model
{
    use HasFactory;
    // use SoftDeletes;
    protected $fillable = [
        'language_id',
        'name',
        'slug',
        'top_store',
        'description',
        'url',
        'destination_url',
        'category',
        'top_store',
        'title',
        'meta_keyword',
        'meta_description',
        'status',
        'authentication',
        'network',
        'store_image',
        'content',
        'about'
    ];

// Store Model


public function language()
{
    return $this->belongsTo(Language::class, 'language_id');
}
public function store_language()
{
    return $this->belongsTo(Language::class, 'language_id');
}
public function category()
{
    return $this->belongsTo(Categories::class, 'category', 'slug');
}

}
