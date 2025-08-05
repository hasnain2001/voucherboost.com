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
        'user_id',
        'category_id',
        'updated_id',

    ];


    public function categories(): BelongsTo
    {
        return $this->belongsTo(Categories::class, 'category_id');
    }

    public function updatedby()
    {
        return $this->belongsTo(User::class, 'updated_id');
    }
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
    public function coupons()
    {
        return $this->hasMany(Coupons::class,'store_id');
    }
    public function slider()
    {
        return $this->hasMany(Slider::class);
    }

}
