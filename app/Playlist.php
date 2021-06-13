<?php

namespace App;

use App\User;
use App\PlaylistItem;
use Illuminate\Database\Eloquent\Model;

class Playlist extends Model
{
  protected $fillable = ['name', 'description'];
  public function user()
  {
    return $this->belongsTo(User::class);
  }

  public function items()
  {
    return $this->hasOne(PlaylistItem::class);
  }
}
