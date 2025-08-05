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
        'image',
        'content',
        'meta_title',
       'meta_description',
        'meta_keyword',
        'top',
        'status',
        'user_id',
        'category_id',
        'store_id',
        'language_id'
    ];
    protected $casts = [
    'created_at' => 'datetime',
    'updated_at' => 'datetime',
];
public $timestamps = true;


    /**
  * Get the user that owns the Stores
  *
  * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
  */
 public function user(): BelongsTo
 {
    return $this->belongsTo(User::class);
 }
   public function updatedby()
    {
        return $this->belongsTo(User::class, 'updated_id');
    }
    public function language()
    {
        return $this->belongsTo(Language::class, 'language_id');
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
