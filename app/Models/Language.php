<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
class Language extends Model
{
    protected $table = 'language';
    protected $fillable =[
        'name',
        'code',
        'flag',
    ];

    /**
     * Get all of the coupons for the Language
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function stores():HasMany
    {
        return $this->hasMany(Stores::class, 'language_id', 'id');
    }

        public function slider():HasMany
    {
        return $this->hasMany(Slider::class, 'language_id',);
    }

    /**
     * Get all of the coupons for the Language
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function coupons(): HasMany
    {
        return $this->hasMany(Coupons::class, 'language_id', 'id');
    }
}
