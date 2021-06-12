<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserHistory extends Model
{
  protected $fillable = ['video_id'];
  public function user()
  {
    return $this->belongsTo(User::class);
  }
}
