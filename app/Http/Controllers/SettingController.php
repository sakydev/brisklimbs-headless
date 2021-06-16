<?php

namespace App\Http\Controllers;

use App\Setting;
use Illuminate\Http\Request;
use Validator;

class SettingController extends Controller
{
  protected function validator($validator)
  {
    if ($validator->fails()) {
      $errors = $validator->messages()->get('*');
      return api_response($errors, 422, 'error: incomplete / invalid input');
    }
  }

  protected function setting_validation_fails($data)
  {
    $validator = Validator::make($data, [
      'name' => 'required|string|unique:settings',
      'value' => 'required|string'
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
      return api_response(Setting::all(), 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $setting_validation_fails = $this->setting_validation_fails($request->all());
      if ($setting_validation_fails) {
        return $setting_validation_fails;
      }

      $created = Setting::create([
        'name' => $request->name,
        'value' => $request->value
      ]);

      return api_response($created, 201, 'Setting added');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function show($setting)
    {
      $setting = Setting::find($setting);
      return api_response($setting, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $setting)
    {
      $setting = Setting::find($setting);
      if ($setting) {
        $setting->value = $request->value;
        $setting->save();
      }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function destroy($setting)
    {
      $setting = Setting::find($setting);
      if ($setting) {
        $deleted = $setting->delete();

        return api_response_message('Setting deleted', 200);
      }
    }
  }
