<?php

namespace Database\Seeders;

use App\Models\jemaah;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Str;

class JemaahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        for ($i = 0; $i < 10; $i++) {
            jemaah::create([
                'id' => Str::uuid(),
                'nama_lengkap' => $faker->name(),
                'nik' => $faker->unique()->numerify('##############'),
                'tanggal_lahir' => $faker->date(),
                'tempat_lahir' => $faker->city(),
                'file_ktp' => null,
                'file_paspor' => null,
            ]);
        }
    }
}
