<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RegisterTest extends TestCase
{
  use RefreshDatabase;
  /**
   * A basic feature test example.
   *
   * @return void
   */
  public function testsRegistration()
  {
    $payload = [
      'name' => 'Jenny',
      'email' => 'jenny@test.com',
      'password' => 'password'
    ];

    $this->json('post', '/api/register', $payload)
    ->assertStatus(201)
    ->assertJsonStructure([
      'data' => [
        'access_token',
        'token_type',
      ],
    ]);;
  }

  public function testsRegistrationValidation()
  {
    $this->json('post', '/api/register')
    ->assertStatus(422)
    ->assertJson([
      "error" => "error: incomplete input", 
      "status" => 422, 
      "data" => [
       "name" => [
          "The name field is required." 
        ], 
        "email" => [
          "The email field is required." 
        ], 
        "password" => [
          "The password field is required." 
        ] 
      ] 
    ]);
  }
}
