<?php

namespace Database\Seeders;

use App\Models\kategori;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Str;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        $kategori_list = [
            ['nama' => 'Haji Reguler', 'code' => 'HJR'],
            ['nama' => 'Haji Plus', 'code' => 'HJP'],
            ['nama' => 'Umrah Reguler', 'code' => 'UMR'],
            ['nama' => 'Umrah Plus', 'code' => 'UMP'],
        ];

        foreach ($kategori_list as $kategori) {
            kategori::create([
                'id' => strtoupper(Str::random(3)) . '-' . strtoupper(Str::random(3)),
                'nama' => $kategori['nama'],
                'code' => $kategori['code'],
                'tanggal' => $faker->date(),
                'durasi' => $faker->numberBetween(5, 30),
                'harga' => $faker->randomFloat(2, 20000000, 100000000),
                'detail' => $faker->sentence(10),
            ]);
        }
    }
}
