<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Categories extends Model
{
    use HasFactory;
    protected $table = 'categories';
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
    public function stores():HasMany
    {
        return $this->hasMany(Stores::class, 'category', 'id');
    }
    public function coupons():HasMany
    {
        return $this->hasMany(Coupons::class, 'category', 'id');
    }
}
