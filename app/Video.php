<?php

namespace App;
use App\User;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
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

    $results = $results->skip($additional_params['start']);
    $results = $results->take($additional_params['limit']);
    $results = $results->orderBy($sorting_params['sort_by'], $sorting_params['order_by']);

    return $results->get();
  }
}
