<?php

namespace Database\Seeders;

use App\Models\Post;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//        Post::factory()->count(30)->create();

        $faker = \Faker\Factory::create();

        for ($i = 0; $i <= 30; $i++) {
            Post::create([
                'user_id' => rand(0, 20),
                'title' => $faker->title,
                'description' => $faker->title,
                'image' => $faker->image,
            ]);
        }

    }
}
