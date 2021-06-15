<?php

namespace App;
use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Video extends Model
{
  protected $fillable = ['title', 'description', 'filename', 'video_key', 'directory'];
  public function user()
  {
    return $this->hasOne(User::class);
  }

  public function comments()
  {
    return $this->hasMany(Comment::class);
  }

  public function categories()
  {
    return $this->hasOne(Category::class);
  }

  public function list($parameters)
  {
    $results = $this;
    $filtering_params = array(
      'scope' => 'public', 
      'status' => 'ok', 
      'state' => 'active'
    );

    $additional_params = array(
      'start' => 0, 
      'limit' => 10 
    );

    $sorting_params = array(
      'sort_by' => 'id',
      'order_by' => 'DESC'
    );


    foreach ($filtering_params as $name => $value) {
      if (!empty($parameters[$value])) {
        $value = $request->input($name);
      }

      $results = $results->where($name, $value);
    }

    foreach ($additional_params as $name => $value) {
      if (!empty($parameters[$value])) {
        $additional_params[$name] = $request->input($name);
      }
    }

    if (isset($parameters['keyword'])) {
      $results->where('title', 'like', '%' . $parameters['keyword'] . '%');
    }

    $results = $results->skip($additional_params['start']);
    $results = $results->take($additional_params['limit']);
    $results = $results->orderBy($sorting_params['sort_by'], $sorting_params['order_by']);

    return $results->get();
  }

  public function create_key()
  {
    return Str::random(8) . '_x_' . Str::random(9); // 20 chars
  }

  public function create_filename()
  {
    return Str::random(15);
  }

  public function target_directory()
  {
    return date('Y/m/d');
  }
}
