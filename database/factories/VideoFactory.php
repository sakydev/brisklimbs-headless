<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Video;
use Faker\Generator as Faker;

$factory->define(Video::class, function (Faker $faker) {
  $statuses = ['pending', 'processing', 'ok', 'failed'];
  $states = ['active', 'inactive', 'frozen'];
  $scopes = ['public', 'private', 'unlisted'];

  $status = $statuses[array_rand($statuses)];
  $state = $states[array_rand($states)];
  $scope = $scopes[array_rand($scopes)];
  return [
    'title' => $faker->sentence,
    'video_key' => $faker->bothify('?*??*??*??*???*'),
    'filename' => $faker->bothify('?*??*??*??*???*'),
    'user_id' => 1,
    'title' => $faker->realText(40),
    'description' => $faker->paragraph,
    'tags' => implode(',', $faker->words),
    'category_id' => $faker->randomDigit,
    'scope' => 'public',
    'status' => $status,
    'qualities' => '360, 480, 720',
    'duration' => $faker->randomDigit,
    'views' => $faker->randomDigit,
    'comments' => $faker->randomDigit,
    'state' => $state,
  ];
});

