<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\User;

class LoginTest extends TestCase
{
  use RefreshDatabase;
  public function testsUserLogin()
  {
    $user = factory(User::class)->create([
      'email' => 'arya@wall.com',
      'password' => bcrypt('password'),
    ]);

    $payload = ['email' => 'arya@wall.com', 'password' => 'password'];

    $this->json('POST', 'api/login', $payload)
    ->assertStatus(200)
    ->assertJsonStructure([
      'data' => [
        'access_token',
        'token_type',
      ],
    ]);
  }

  public function testsUserLoginValidation()
  {
    $this->json('POST', 'api/login')
    ->assertStatus(422)
    ->assertJson([
      'message' => 'Invalid login details',
    ]);
  }
}
