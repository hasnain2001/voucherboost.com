<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
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
        'about',
        'user_id'
    ];

// Store Model


public function language()
{
    return $this->belongsTo(Language::class,);
}
public function store_language()
{
    return $this->belongsTo(Language::class, );
}
 /**
  * Get the user that owns the Stores
  *
  * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
  */
 public function user(): BelongsTo
 {
    return $this->belongsTo(User::class);
 }


}
