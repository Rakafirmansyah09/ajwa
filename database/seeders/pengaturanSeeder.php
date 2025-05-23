<?php

namespace Database\Seeders;

use App\Models\pengaturan_web;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class pengaturanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'code' => 'nama_perusahaan',
                'value' => 'AJWA Tour & Travel',
                'canDelete' => false,
            ],
            [
                'code' => 'alamat_perusahaan',
                'value' => 'Jl. Raya Cibinong No. 1, Cibinong, Bogor',
                'canDelete' => false,
            ],
            [
                'code' => 'email_perusahaan',
                'value' => 'info@ajwa.com',
                'canDelete' => false,
            ],
            [
                'code' => 'no_telp_perusahaan',
                'value' => '021-88888888',
                'canDelete' => false,
            ],
            [
                'code' => 'no_hp_perusahaan',
                'value' => '081234567890',
                'canDelete' => false,
            ],
            [
                'code' => 'web_perusahaan',
                'value' => 'www.ajwa.com',
                'canDelete' => false,
            ]
        ];

        foreach ($data as $item) {
            pengaturan_web::create($item);
        }
    }
}
