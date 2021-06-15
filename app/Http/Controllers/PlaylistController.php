<?php

namespace App\Http\Controllers;

use App\Playlist;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class PlaylistController extends Controller
{
  protected function validator($validator)
  {
    if ($validator->fails()) {
      $errors = $validator->messages()->get('*');
      return api_response($errors, 422, 'error: incomplete / invalid input');
    }
  }

  protected function playlist_validation_fails($data)
  {
    $validator = Validator::make($data, [
      'name' => 'required|string'
    ]);

    return $this->validator($validator);
  }

  protected function item_validation_fails($data)
  {
    $validator = Validator::make($data, [
      'video' => 'required|integer'
    ]);

    return $this->validator($validator);
  }

  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index(Request $request, $user)
  {
    $limit = $request->filled('limit') ? $request->get('limit') : 10;
    $start = $request->filled('start') ? $request->get('start') : 0;

    $user = User::find($user);
    $results = $user->playlists()->skip($start)->take($limit)->get();
    return api_response($results, 200, 'no_results');
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request, $user)
  {
    $validation_fails = $this->playlist_validation_fails($request->all());
    if ($validation_fails) {
      return $validation_fails;
    }

    $user = User::find($user);
    $created = $user->playlists()->create([
      'name' => $request->name,
      'description' => $request->description
    ]);

    return api_response($created, 201, 'Playlist created successfully');
  }

  public function store_item(Request $request, $user, $playlist)
  {
    $validation_fails = $this->item_validation_fails($request->all());
    if ($validation_fails) {
      return $validation_fails;
    }

    $user = User::find($user);
    $playlist = $user->playlists()->find($playlist);

    $created = $playlist->items()->create([
      'video_id' => $request->video,
    ]);

    return api_response($created, 201, 'Video added to playlist');
  }

  /**
   * Display the specified resource.
   *
   * @param  \App\Playlist  $playlist
   * @return \Illuminate\Http\Response
   */
  public function show($user, $playlist)
  {
    $user = User::find($user);
    $result = $user->playlists()->find($playlist);
    return api_response($result, 200, 'no_results');
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Playlist  $playlist
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, $user, $playlist)
  {
    $validation_fails = $this->validation_fails($request->all());
    if ($validation_fails) {
      return $validation_fails;
    }

    $user = User::find($user);
    $playlist = $user->playlists()->find($playlist);
    $updated = $playlist->update([
      'name' => $request->name,
      'description' => $request->description
    ]);

    return api_response($playlist, 200, 'Playlist updated');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Playlist  $playlist
   * @return \Illuminate\Http\Response
   */
  public function destroy($user, $playlist)
  {
    $playlist = $user->find($user)->playlists()->find($playlist);
    $playlist->items()->delete();
    $playlist->delete();

    return api_response_message('Playlist deleted with all contents', 200);
  }

  public function destroy_item($user, $playlist, $video)
  {
    $item = User::find($user)->playlists->find($playlist)->items->find($video);
    $deleted = $item->delete();

    return api_response($deleted, 200, 'Video removed from playlist');
  }
}
