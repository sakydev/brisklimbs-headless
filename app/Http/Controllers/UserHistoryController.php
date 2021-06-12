<?php

namespace App\Http\Controllers;

use App\UserHistory;
use App\User;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class UserHistoryController extends Controller
{
  protected function validated($request)
  {
    $validator = Validator::make($request, [
      'video' => 'required|integer'
    ]);

    if ($validator->fails()) {
      $errors = $validator->messages()->get('*');
      return api_response($errors, 422, 'error: incomplete input');
    }
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

    $results = UserHistory::where('user_id', $user)->skip($start)->take($limit)->get();
    return api_response($results, 200);
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request, User $user)
  { 
    $validated = $this->validated($request->all());
    if (!empty($validated)) {
      return $validated;
    }

    $created = $user->watched()->create([
      'video_id' => $request->get('video')
    ]);

    return api_response($created, 201);
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\UserHistory  $userHistory
   * @return \Illuminate\Http\Response
   */
  public function destroy(User $user, $video = false)
  {
    if ($video) {
      $user->watched()->where('video_id', $video)->delete();
      return api_response(compact('video'), 200, 'Video deleted successfully');
    }

    $user->watched()->delete();
    return api_response_message('All watch history deleted', 200);
  }
}
