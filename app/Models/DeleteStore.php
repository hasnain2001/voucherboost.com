<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DeleteStore extends Model
{
    // protected $table = 'delete_store';
    protected $fillable = ['store_id', 'store_name', 'deleted_by'];
    
    public function deletedBy()
    {
        return $this->belongsTo(User::class, 'deleted_by');
    }
}
