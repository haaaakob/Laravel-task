<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//        User::factory()->count(30)->create();
        $faker = \Faker\Factory::create();
        for ($i = 0; $i <= 20; $i++) {
            User::create([
                'name' => $faker->firstName(),
                'surname' => $faker->lastName(),
                'email' => $faker->unique()->safeEmail(),
                'email_verified_at' => now(),
                'password' => '2444666668888888', // password
                'remember_token' => Str::random(10),
            ]);
        }
        User::create([
            'name' => 'Hakob',
            'surname' => 'Hakobyan',
            'email' => 'hakob@mail.ru',
            'email_verified_at' => now(),
            'password' => '2444666668888888', // password
            'remember_token' => Str::random(10),
            'is_admin' => 1
        ]);
    }

}
