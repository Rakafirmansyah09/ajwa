<?php

namespace Database\Seeders;

use App\Models\akomodasi;
use App\Models\fasilitas;
use App\Models\group;
use App\Models\itinerary;
use App\Models\jadwalPenerbangan;
use App\Models\paket;
use App\Models\paketKeberangkatan;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Str;

class PaketSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $paket = Paket::create([
            'id' => Str::uuid(),
            'nama' => 'Umroh Hemat April 2025',
            'gambar' => null,
            'code' => 'UMH2025',
            'durasi' => 9,
            'harga' => 28000000,
            'kuota' => 45,
            'detail' => 'Paket umroh hemat dengan fasilitas standar.',
            'fasilitas' => json_encode([
                [
                    'nama' => 'Tiket Pesawat PP'
                ],
                [
                    'nama' => 'Hotel Makkah dan Madinah'
                ],
                [
                    'nama' => 'Makan 3x sehari'
                ],
                [
                    'nama' => 'Bus AC'
                ],
                [
                    'nama' => 'Air Zamzam 5 Liter'
                ]
            ]),            'itinerary' => json_encode([
                [
                    'judul' => 'Keberangkatan dari Jakarta',
                    'deskripsi' => 'Check in di Bandara Soekarno-Hatta dan penerbangan menuju Madinah',
                    'lokasi' => 'Bandara Soekarno-Hatta, Jakarta'
                ],
                [
                    'judul' => 'Tiba di Madinah - Ziarah',
                    'deskripsi' => 'Tiba di Madinah dilanjutkan check in hotel dan ziarah ke tempat bersejarah',
                    'lokasi' => 'Madinah, Saudi Arabia'
                ],
                [
                    'judul' => 'Ibadah di Masjid Nabawi',
                    'deskripsi' => 'Shalat berjamaah dan ibadah di Masjid Nabawi',
                    'lokasi' => 'Masjid Nabawi, Madinah'
                ],
                [
                    'judul' => 'Menuju Makkah - Umrah',
                    'deskripsi' => 'Perjalanan menuju Makkah dan pelaksanaan ibadah umrah pertama',
                    'lokasi' => 'Makkah, Saudi Arabia'
                ],
                [
                    'judul' => 'Ibadah di Makkah',
                    'deskripsi' => 'Ibadah di Masjidil Haram dan tawaf sunnah',
                    'lokasi' => 'Masjidil Haram, Makkah'
                ],
                [
                    'judul' => 'City Tour Makkah',
                    'deskripsi' => 'Mengunjungi tempat-tempat bersejarah di sekitar Makkah',
                    'lokasi' => 'Makkah, Saudi Arabia'
                ],
                [
                    'judul' => 'Kepulangan ke Tanah Air',
                    'deskripsi' => 'Check out hotel dan penerbangan kembali ke Jakarta',
                    'lokasi' => 'Bandara King Abdulaziz, Jeddah'
                ],
            ]),
        ]);

        group::create([
            'id' => Str::uuid(),
            'paket_id' => $paket->id,
            'nama' => 'Batch 1',
            'tanggal_keberangkatan' => '2025-04-20',
            'tanggal_kepulangan' => '2025-04-29',

            'jadwal_penerbangan' => json_encode([
                [
                    'judul' => 'Jakarta - Madinah',
                    'maskapai' => 'Garuda Indonesia',
                    'tanggal_keberangkatan' => '2025-04-20',
                    'tanggal_tiba' => '2025-04-20',
                    'lama_penerbangan' => '12 jam',
                    'bagasi' => '30 kg',
                    'bagasi_kabin' => '7 kg',
                    'kursi' => 'Economy',
                    'bandara_asal' => 'Soekarno-Hatta',
                    'bandara_tujuan' => 'Prince Mohammad bin Abdulaziz',
                    'kota_asal' => 'Jakarta',
                    'kota_tujuan' => 'Madinah',
                ],
                [
                    'judul' => 'Jeddah - Jakarta',
                    'maskapai' => 'Garuda Indonesia',
                    'tanggal_keberangkatan' => '2025-04-29',
                    'tanggal_tiba' => '2025-04-30',
                    'lama_penerbangan' => '12 jam',
                    'bagasi' => '30 kg',
                    'bagasi_kabin' => '7 kg',
                    'kursi' => 'Economy',
                    'bandara_asal' => 'King Abdulaziz',
                    'bandara_tujuan' => 'Soekarno-Hatta',
                    'kota_asal' => 'Jeddah',
                    'kota_tujuan' => 'Jakarta',
                ]
            ]),
            'akomodasi' => json_encode([
                [
                    'nama_hotel' => 'Hotel Al Haram',
                    'kota' => 'Madinah',
                    'alamat' => 'Jl. King Fahd, Madinah, Saudi Arabia',
                    'tanggal_checkin' => '2025-04-20',
                    'tanggal_checkout' => '2025-04-23',
                    'rating' => 5
                ],
                [
                    'nama_hotel' => 'Hotel Zamzam Tower',
                    'kota' => 'Makkah',
                    'alamat' => 'Abraj Al Bait Complex, Makkah, Saudi Arabia',
                    'tanggal_checkin' => '2025-04-23',
                    'tanggal_checkout' => '2025-04-29',
                    'rating' => 5
                ]
            ]),
        ]);
    }
}
