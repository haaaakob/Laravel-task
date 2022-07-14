<?php

namespace Database\Seeders;

use App\Models\Comment;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();

        for ($i = 0; $i <= 50; $i++) {
            Comment::create([
                'user_id' => rand(0, 20),
                'post_id' => rand(0, 30),
                'text' => $faker->firstName
            ]);
        }
    }
}
