<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DeleteCoupons extends Model
{
  // protected $table = 'delete_store';
  protected $fillable = ['coupon_id', 'coupon_name', 'deleted_by'];
    
  public function deletedBy()
  {
      return $this->belongsTo(User::class, 'deleted_by');
  }
}
