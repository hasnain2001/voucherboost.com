<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
        'store',

    ];
    protected $casts = [
        'ending_date' => 'datetime',
    ];

    public function language()
{
    return $this->belongsTo(Language::class, 'language_id');
}
}
