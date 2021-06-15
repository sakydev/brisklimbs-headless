<?php

namespace App\Http\Controllers;

use App\Video;
use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Facades\Auth;

class VideoController extends Controller
{
  protected function validator($validator)
  {
    if ($validator->fails()) {
      $errors = $validator->messages()->get('*');
      return api_response($errors, 422, 'error: incomplete / invalid input');
    }
  }

  protected function upload_validation_fails($data)
  {
    $validator = Validator::make($data, [
      'title' => 'required|string',
      'file' => 'required|mimes:mp4,wmv,mov,mpeg'
    ]);

    return $this->validator($validator);
  }

  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index(Request $request)
  {
    $videos = new Video;
    $results = $videos->list($request->all());
    return api_response($results, 200);
  }

  public function search(Request $request, $keyword)
  {
    $videos = new Video;
    $parameters = array('keyword' => $keyword);
    $parameters = array_merge($parameters, $request->all());
    $results = $videos->list($parameters);
    return api_response($results, 200);
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    $upload_validation_fails = $this->upload_validation_fails($request->all());
    if ($upload_validation_fails) {
      return $upload_validation_fails;
    }

    $video = new Video;
    $key = $video->create_key();
    $filename = $video->create_filename();
    $directory = $video->target_directory();

    $path = $request->file('file')->storeAs(
      'public/uploads/videos/temp', $filename . '.' . $request->file('file')->clientExtension()
    );

    $user = Auth::user();
    $created = $user->videos()->create([
      'title' => $request->title,
      'description' => $request->description,
      'video_key' => $key,
      'filename' => $filename,
      'directory' => $directory
    ]);

    $created['path'] = $path;
    return api_response($created, 201, 'Video uploaded');
  }

  /**
   * Display the specified resource.
   *
   * @param  \App\Video  $video
   * @return \Illuminate\Http\Response
   */
  public function show($video, $field = false)
  {
    if ($field) {
      $fields = explode(',', $field);
    }

    $result = Video::find($video, $fields);
    return api_response($result, 200, 'no_results');
  }


  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Video  $video
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, Video $video)
  {
      //
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Video  $video
   * @return \Illuminate\Http\Response
   */
  public function destroy(Video $video)
  {
      //
  }
}
