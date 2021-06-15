<?php

namespace App\Http\Controllers;

use App\Category;
use App\Video;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
  protected function validator($validator)
  {
    if ($validator->fails()) {
      $errors = $validator->messages()->get('*');
      return api_response($errors, 422, 'error: incomplete / invalid input');
    }
  }

  protected function category_validation_fails($data)
  {
    $validator = Validator::make($data, [
      'name' => 'required|string|unique:categories'
    ]);

    return $this->validator($validator);
  }

  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $results = Category::all();
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
    $category_validation_fails = $this->category_validation_fails($request->all());
    if ($category_validation_fails) {
      return $category_validation_fails;
    }

    $created = Category::create([
      'name' => $request->name,
      'description' => $request->description
    ]);

    return api_response($created, 201, 'Category created successfully');
  }

  /**
   * Display the specified resource.
   *
   * @param  \App\Category  $category
   * @return \Illuminate\Http\Response
   */
  public function show($category)
  {
    $category = Category::find($category);
    return api_response($category, 200);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Category  $category
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, $category)
  {
    $category = Category::find($category);
    if (!$category) {
      return api_response_error('Category not found', 404);
    }

    $category_validation_fails = $this->category_validation_fails($request->all());
    if ($category_validation_fails) {
      return $category_validation_fails;
    }

    if ($category->name != $request->name) {
      $category->name = $request->name;
    }

    if ($request->description) {
      $category->description = $request->description;
    }

    $category->save();

    return api_response($category, 200, 'Category updated');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Category  $category
   * @return \Illuminate\Http\Response
   */
  public function destroy($category)
  {
    $category = Category::find($category);
    if (!$category) {
      return api_response_error('Category not found', 404);
    }

    // first update all videos with this category to uncategorized
    $videos = $category->videos()->update(['category_id' => 1]);
    $category->delete();

    return api_response_message('Category deleted', 200);
  }
}
