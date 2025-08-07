<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    protected $fillable = [
        'title',
        'description',
        'image',
        'status',
        'store_id',
        'user_id',
        'updated_id',
        'category_id',
        'language_id',
        'store_id',
        'ur',
    ];
   protected $casts = [
        'status' => 'boolean',
        'sort_order' => 'integer',
    ];
      public function language()
    {
        return $this->belongsTo(Language::class);
    }
          public function user()
    {
        return $this->belongsTo(User::class);
    }
          public function updateby()
    {
        return $this->belongsTo(User::class);
    }
          public function category()
    {
        return $this->belongsTo(Categories::class);
    }
      public function store()
    {
        return $this->belongsTo(Stores::class);
    }

}
