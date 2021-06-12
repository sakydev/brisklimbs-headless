<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
  /**
   * Get a validator for an incoming registration request.
   *
   * @param  array  $data
   * @return \Illuminate\Contracts\Validation\Validator
   */
  protected function validator(array $data)
  {
    return Validator::make($data, [
      'name' => 'required|string|max:255',
      'email' => 'required|string|email|max:255|unique:users',
      'password' => 'required|string|min:4',
    ]);
  }

  public function register(Request $request)
  {
    $validated = $this->validator($request->all());
    if ($validated->fails()) {
      $fieldsWithErrors = $validated->messages()->get('*');
      return api_response($fieldsWithErrors, 422, 'error: incomplete input');
    }

    $user = User::create([
      'name' => $request->name,
      'email' => $request->email,
      'password' => Hash::make($request->password),
    ]);

    $token = $user->createToken('auth_token')->plainTextToken;

    return api_response([
      'access_token' => $token,
      'token_type' => 'Bearer',
      'data' => $user
    ], 201);
  }

  public function login(Request $request)
  {
    if (!Auth::attempt($request->only('email', 'password'))) {
      return response()->json([
        'message' => 'Invalid login details'
      ], 422);
    }

    $user = User::where('email', $request['email'])->firstOrFail();

    $token = $user->createToken('auth_token')->plainTextToken;

    return api_response([
     'access_token' => $token,
     'token_type' => 'Bearer',
   ], 200);
  }
}
