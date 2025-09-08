<?php

namespace Database\Seeders;

use App\Models\faq;
use App\Models\news;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Carbon\Carbon;

class NewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $dummyDataNews = [
            [
                'judul' => 'Pembukaan Umroh Tahun Ini',
                'gambar' => '',
                'content' => 'Pemerintah Arab Saudi resmi membuka kembali layanan ibadah umroh untuk jemaah internasional.',
                'author' => 'Admin',
                'status' => 'publish',
                'tanggal_publish' => Carbon::now(),
            ],
            [
                'judul' => 'Tips Persiapan Umroh Pertama Kali',
                'gambar' => '',
                'content' => 'Bagi yang pertama kali berangkat umroh, berikut adalah beberapa tips penting agar ibadah berjalan lancar.',
                'author' => 'Admin',
                'status' => 'draft',
                'tanggal_publish' => Carbon::now()->subDays(5),
            ],
        ];

        $dummyDataFaQ = [
            [
                'pertanyaan' => 'Apa yang harus saya bawa saat berangkat umroh?',
                'jawaban' => 'Sebaiknya bawa pakaian yang nyaman dan bersih, serta peralatan kebersihan seperti hand sanitizer dan masker.',
            ],
            [
                'pertanyaan' => 'Apakah saya harus membawa uang tunai saat berangkat umroh?',
                'jawaban' => 'Ya, sebaiknya bawa uang tunai dalam mata uang Saudi Riyal atau dolar Amerika Serikat.',
            ],
        ];

        foreach ($dummyDataNews as $data) {
            news::create($data);
        }

        foreach ($dummyDataFaQ as $data) {
            faq::create($data);
        }
    }
}
