<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DeleteBlogs extends Model
{
  // protected $table = 'delete_store';
  protected $fillable = ['blog_id', 'blog_title', 'deleted_by'];
    
  public function deletedBy()
  {
      return $this->belongsTo(User::class, 'deleted_by');
  }
}
