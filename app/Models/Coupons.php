<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
class Coupons extends Model
{
    use HasFactory;
    protected $fillable = [
        'language_id',
        'name',
        'clicks',
        'order',
        'description',
        'code',
        'destination_url',
        'top_coupons',
        'ending_date',
        'status',
        'authentication',
        'user_id',
        'updated_id',
         'store_id',

    ];
    protected $casts = [
        'ending_date' => 'datetime',
    ];

    public function language()
{
    return $this->belongsTo(Language::class, );
}
    public function stores()
    {
        return $this->belongsTo(Stores::class,'store_id' );
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


     public function updatedby()
    {
        return $this->belongsTo(User::class, 'updated_id');
    }
}
