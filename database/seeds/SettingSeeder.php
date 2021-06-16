<?php

use App\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Setting::create(['name' => 'allow_signups', 'value' => 1]);
        Setting::create(['name' => 'max_video_size', 'value' => '20MB']);
    }
}
