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

        for ($i = 0; $i <= 30; $i++) {
            Post::create([
                'user_id' => rand(0, 20),
                'title' => $this->$GLOBALS->title,
                'description' => $this->$GLOBALS->title,
                'image' => $this->$GLOBALS->image,
            ]);
        }

    }
}
