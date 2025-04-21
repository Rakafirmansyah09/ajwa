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
        ]);

        $group = group::create([
            'id' => Str::uuid(),
            'paket_id' => $paket->id,
            'nama' => 'Batch 1',
            'tanggal_keberangkatan' => '2025-04-20',
            'tanggal_kepulangan' => '2025-04-29',
        ]);

        jadwalPenerbangan::create([
            'id' => Str::uuid(),
            'group_id' => $group->id,
            'judul' => 'Jakarta - Madinah',
            'maskapai' => 'Garuda Indonesia',
            'tanggal_berangkat' => '2025-04-20 10:00:00',
            'tanggal_tiba' => '2025-04-20 18:00:00',
            'lama_penerbangan' => 8,
            'bagasi' => 30,
            'bagasi_kabin' => 7,
            'kursi' => '45A',
            'bandara_asal' => 'Soekarno-Hatta',
            'kota_bandara_asal' => 'Jakarta',
            'bandara_tujuan' => 'Prince Mohammad bin Abdulaziz',
            'kota_bandara_tujuan' => 'Madinah',
        ]);

        akomodasi::create([
            'id' => Str::uuid(),
            'group_id' => $group->id,
            'nama_hotel' => 'Hotel Madinah Al Haram',
            'kota' => 'Madinah',
            'alamat' => 'Dekat Masjid Nabawi',
            'tanggal_checkin' => '2025-04-20',
            'tanggal_checkout' => '2025-04-24',
            'rating' => 4,
        ]);

        itinerary::create([
            'id' => Str::uuid(),
            'paket_id' => $paket->id,
            'tanggal' => '2025-04-21',
            'judul_kegiatan' => 'Ziarah ke Masjid Quba',
            'deskripsi' => 'Mengunjungi salah satu masjid tertua di Madinah',
            'lokasi' => 'Madinah',
        ]);

        fasilitas::create([
            'id' => Str::uuid(),
            'paket_id' => $paket->id,
            'nama_fasilitas' => 'Bus AC & Makanan 3x Sehari',
        ]);
    }
}
