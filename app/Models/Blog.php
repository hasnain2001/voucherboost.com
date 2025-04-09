<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
        'top',
        'status',
        'user_id',
    ];
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
