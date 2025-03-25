<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Str;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID');
        for ($i = 1; $i < 4; $i++) {
            User::create([
                'name' => $faker->name(),
                'email' => 'user' . $i . '@example.com',
                'password' => bcrypt('password'),
            ]);
        }
    }
}
