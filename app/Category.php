<?php

namespace App;

use App\Video;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name', 'description'];

    public function videos()
    {
        return $this->hasMany(Video::class);
    }
}
