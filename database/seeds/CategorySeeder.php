<?php

use Illuminate\Database\Seeder;
use App\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // creating default category
        Category::create([
            'name' => 'Uncategorized',
            'description' => 'Videos that don\'t fit anywhere else'
        ]);
        
        factory(App\Category::class, 10)->create();

    }
}
