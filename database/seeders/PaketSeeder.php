<?php

namespace Database\Seeders;

use App\Models\akomodasi;
use App\Models\fasilitas;
use App\Models\group;
use App\Models\itinerary;
use App\Models\jadwalPenerbangan;
use App\Models\paket;
use App\Models\paketKeberangkatan;
use App\Models\sales;
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
        $paket1 = paket::create([
            'id' => Str::uuid(),
            'nama' => 'Umroh Reguler Desember 2024',
            'gambar' => null,
            'code' => 'URD2024',
            'durasi' => 10,
            'harga' => 32000000,
            'kuota' => 40,
            'detail' => 'Paket umroh reguler dengan fasilitas standar plus.',
            'fasilitas' => json_encode([
                ['nama' => 'Tiket Pesawat PP'],
                ['nama' => 'Hotel Bintang 4'],
                ['nama' => 'Makan 3x sehari'],
                ['nama' => 'Bus AC Executive'],
                ['nama' => 'Air Zamzam 5 Liter'],
                ['nama' => 'Visa Umroh']
            ]),
            'itinerary' => json_encode([
                [
                    'judul' => 'Keberangkatan dari Jakarta',
                    'deskripsi' => 'Check in di Bandara Soekarno-Hatta dan penerbangan menuju Jeddah',
                    'lokasi' => 'Bandara Soekarno-Hatta, Jakarta'
                ],
                [
                    'judul' => 'Tiba di Madinah',
                    'deskripsi' => 'Tiba di Madinah dan check in hotel',
                    'lokasi' => 'Madinah, Saudi Arabia'
                ],
                [
                    'judul' => 'Ziarah Madinah',
                    'deskripsi' => 'Ziarah ke tempat bersejarah di Madinah',
                    'lokasi' => 'Madinah, Saudi Arabia'
                ],
                [
                    'judul' => 'Menuju Makkah',
                    'deskripsi' => 'Perjalanan menuju Makkah dan Umrah pertama',
                    'lokasi' => 'Makkah, Saudi Arabia'
                ],
                [
                    'judul' => 'Ibadah di Makkah',
                    'deskripsi' => 'Ibadah di Masjidil Haram',
                    'lokasi' => 'Makkah, Saudi Arabia'
                ],
                [
                    'judul' => 'Kepulangan',
                    'deskripsi' => 'Check out hotel dan penerbangan kembali ke Jakarta',
                    'lokasi' => 'Jeddah, Saudi Arabia'
                ]
            ]),
        ]);
        group::create([
            'id' => Str::uuid(),
            'paket_id' => $paket1->id,
            'nama' => 'Grup Desember',
            'tanggal_keberangkatan' => '2025-12-10',
            'tanggal_kepulangan' => '2025-12-20',
            'jadwal_penerbangan' => json_encode([
                [
                    'judul' => 'Jakarta - Jeddah',
                    'maskapai' => 'Saudia Airlines',
                    'tanggal_berangkat' => '2024-12-10',
                    'tanggal_tiba' => '2024-12-10',
                    'lama_penerbangan' => '11 jam',
                    'bagasi' => '30 kg',
                    'bagasi_kabin' => '7 kg',
                    'kursi' => 'Economy',
                    'bandara_asal' => 'Soekarno-Hatta',
                    'bandara_tujuan' => 'King Abdulaziz',
                    'kota_asal' => 'Jakarta',
                    'kota_tujuan' => 'Jeddah',
                ],
                [
                    'judul' => 'Jeddah - Jakarta',
                    'maskapai' => 'Saudia Airlines',
                    'tanggal_berangkat' => '2024-12-20',
                    'tanggal_tiba' => '2024-12-21',
                    'lama_penerbangan' => '11 jam',
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
                    'nama_hotel' => 'Le Meridien Madinah',
                    'kota' => 'Madinah',
                    'alamat' => 'Khaled Bin El Walid Road, Madinah',
                    'tanggal_checkin' => '2024-12-10',
                    'tanggal_checkout' => '2024-12-14',
                    'rating' => 4
                ],
                [
                    'nama_hotel' => 'Swissotel Al Maqam Makkah',
                    'kota' => 'Makkah',
                    'alamat' => 'Abraj Al Bait Complex, Makkah',
                    'tanggal_checkin' => '2024-12-14',
                    'tanggal_checkout' => '2024-12-20',
                    'rating' => 4
                ]
            ]),
        ]);

        $paket2 = paket::create([
            'id' => Str::uuid(),
            'nama' => 'Umroh Plus Istanbul Januari 2025',
            'gambar' => null,
            'code' => 'UPI2025',
            'durasi' => 13,
            'harga' => 45000000,
            'kuota' => 25,
            'detail' => 'Paket umroh plus wisata Istanbul.',
            'fasilitas' => json_encode([
                ['nama' => 'Tiket Pesawat PP'],
                ['nama' => 'Hotel Bintang 5'],
                ['nama' => 'Makan 3x sehari'],
                ['nama' => 'Bus AC Executive'],
                ['nama' => 'Air Zamzam 5 Liter'],
                ['nama' => 'Tour Istanbul 3 Hari'],
                ['nama' => 'Visa Umroh & Turki']
            ]),
            'itinerary' => json_encode([
                [
                    'judul' => 'Jakarta - Istanbul',
                    'deskripsi' => 'Penerbangan ke Istanbul',
                    'lokasi' => 'Istanbul, Turki'
                ],
                [
                    'judul' => 'Tour Istanbul',
                    'deskripsi' => 'Mengunjungi tempat bersejarah di Istanbul',
                    'lokasi' => 'Istanbul, Turki'
                ],
                [
                    'judul' => 'Menuju Madinah',
                    'deskripsi' => 'Penerbangan ke Madinah',
                    'lokasi' => 'Madinah, Saudi Arabia'
                ],
                [
                    'judul' => 'Ziarah Madinah',
                    'deskripsi' => 'Ziarah tempat bersejarah di Madinah',
                    'lokasi' => 'Madinah, Saudi Arabia'
                ],
                [
                    'judul' => 'Makkah',
                    'deskripsi' => 'Umrah dan ibadah di Makkah',
                    'lokasi' => 'Makkah, Saudi Arabia'
                ],
                [
                    'judul' => 'Kepulangan',
                    'deskripsi' => 'Penerbangan kembali ke Jakarta',
                    'lokasi' => 'Jeddah, Saudi Arabia'
                ]
            ]),
        ]);
        group::create([
            'id' => Str::uuid(),
            'paket_id' => $paket2->id,
            'nama' => 'Grup Januari',
            'tanggal_keberangkatan' => '2025-01-15',
            'tanggal_kepulangan' => '2025-01-28',
            'jadwal_penerbangan' => json_encode([
                [
                    'judul' => 'Jakarta - Istanbul',
                    'maskapai' => 'Turkish Airlines',
                    'tanggal_berangkat' => '2025-01-15',
                    'tanggal_tiba' => '2025-01-16',
                    'lama_penerbangan' => '14 jam',
                    'bagasi' => '35 kg',
                    'bagasi_kabin' => '8 kg',
                    'kursi' => 'Economy',
                    'bandara_asal' => 'Soekarno-Hatta',
                    'bandara_tujuan' => 'Istanbul Airport',
                    'kota_asal' => 'Jakarta',
                    'kota_tujuan' => 'Istanbul',
                ],
                [
                    'judul' => 'Istanbul - Madinah',
                    'maskapai' => 'Turkish Airlines',
                    'tanggal_berangkat' => '2025-01-19',
                    'tanggal_tiba' => '2025-01-19',
                    'lama_penerbangan' => '4 jam',
                    'bagasi' => '35 kg',
                    'bagasi_kabin' => '8 kg',
                    'kursi' => 'Economy',
                    'bandara_asal' => 'Istanbul Airport',
                    'bandara_tujuan' => 'Prince Mohammad bin Abdulaziz',
                    'kota_asal' => 'Istanbul',
                    'kota_tujuan' => 'Madinah',
                ],
                [
                    'judul' => 'Jeddah - Jakarta',
                    'maskapai' => 'Turkish Airlines',
                    'tanggal_berangkat' => '2025-01-28',
                    'tanggal_tiba' => '2025-01-29',
                    'lama_penerbangan' => '15 jam',
                    'bagasi' => '35 kg',
                    'bagasi_kabin' => '8 kg',
                    'kursi' => 'Economy',
                    'bandara_asal' => 'King Abdulaziz',
                    'bandara_tujuan' => 'Soekarno-Hatta',
                    'kota_asal' => 'Jeddah',
                    'kota_tujuan' => 'Jakarta',
                ]
            ]),
            'akomodasi' => json_encode([
                [
                    'nama_hotel' => 'Crowne Plaza Istanbul',
                    'kota' => 'Istanbul',
                    'alamat' => 'Harbiye Mahallesi, Istanbul',
                    'tanggal_checkin' => '2025-01-16',
                    'tanggal_checkout' => '2025-01-19',
                    'rating' => 5
                ],
                [
                    'nama_hotel' => 'Pullman Zamzam Madinah',
                    'kota' => 'Madinah',
                    'alamat' => 'Central Area, Madinah',
                    'tanggal_checkin' => '2025-01-19',
                    'tanggal_checkout' => '2025-01-22',
                    'rating' => 5
                ],
                [
                    'nama_hotel' => 'Hilton Suites Makkah',
                    'kota' => 'Makkah',
                    'alamat' => 'Ibrahim Al Khalil Street, Makkah',
                    'tanggal_checkin' => '2025-01-22',
                    'tanggal_checkout' => '2025-01-28',
                    'rating' => 5
                ]
            ]),
        ]);

        $paket3 = paket::create([
            'id' => Str::uuid(),
            'nama' => 'Umroh Plus Istanbul Januari 2026',
            'gambar' => null,
            'code' => 'UPI2026',
            'durasi' => 13,
            'harga' => 45000000,
            'kuota' => 25,
            'detail' => 'Paket umroh plus wisata Istanbul.',
            'fasilitas' => json_encode([
                ['nama' => 'Tiket Pesawat PP'],
                ['nama' => 'Hotel Bintang 5'],
                ['nama' => 'Makan 3x sehari'],
                ['nama' => 'Bus AC Executive'],
                ['nama' => 'Air Zamzam 5 Liter'],
                ['nama' => 'Tour Istanbul 3 Hari'],
                ['nama' => 'Visa Umroh & Turki']
            ]),
            'itinerary' => json_encode([
                [
                    'judul' => 'Jakarta - Istanbul',
                    'deskripsi' => 'Penerbangan ke Istanbul',
                    'lokasi' => 'Istanbul, Turki'
                ],
                [
                    'judul' => 'Tour Istanbul',
                    'deskripsi' => 'Mengunjungi tempat bersejarah di Istanbul',
                    'lokasi' => 'Istanbul, Turki'
                ],
                [
                    'judul' => 'Menuju Madinah',
                    'deskripsi' => 'Penerbangan ke Madinah',
                    'lokasi' => 'Madinah, Saudi Arabia'
                ],
                [
                    'judul' => 'Ziarah Madinah',
                    'deskripsi' => 'Ziarah tempat bersejarah di Madinah',
                    'lokasi' => 'Madinah, Saudi Arabia'
                ],
                [
                    'judul' => 'Makkah',
                    'deskripsi' => 'Umrah dan ibadah di Makkah',
                    'lokasi' => 'Makkah, Saudi Arabia'
                ],
                [
                    'judul' => 'Kepulangan',
                    'deskripsi' => 'Penerbangan kembali ke Jakarta',
                    'lokasi' => 'Jeddah, Saudi Arabia'
                ]
            ]),
        ]);
        group::create([
            'id' => Str::uuid(),
            'paket_id' => $paket3->id,
            'nama' => 'Grup Januari',
            'tanggal_keberangkatan' => '2026-01-15',
            'tanggal_kepulangan' => '2026-01-28',
            'jadwal_penerbangan' => json_encode([
                [
                    'judul' => 'Jakarta - Istanbul',
                    'maskapai' => 'Turkish Airlines',
                    'tanggal_berangkat' => '2025-01-15',
                    'tanggal_tiba' => '2025-01-16',
                    'lama_penerbangan' => '14 jam',
                    'bagasi' => '35 kg',
                    'bagasi_kabin' => '8 kg',
                    'kursi' => 'Economy',
                    'bandara_asal' => 'Soekarno-Hatta',
                    'bandara_tujuan' => 'Istanbul Airport',
                    'kota_asal' => 'Jakarta',
                    'kota_tujuan' => 'Istanbul',
                ],
                [
                    'judul' => 'Istanbul - Madinah',
                    'maskapai' => 'Turkish Airlines',
                    'tanggal_berangkat' => '2025-01-19',
                    'tanggal_tiba' => '2025-01-19',
                    'lama_penerbangan' => '4 jam',
                    'bagasi' => '35 kg',
                    'bagasi_kabin' => '8 kg',
                    'kursi' => 'Economy',
                    'bandara_asal' => 'Istanbul Airport',
                    'bandara_tujuan' => 'Prince Mohammad bin Abdulaziz',
                    'kota_asal' => 'Istanbul',
                    'kota_tujuan' => 'Madinah',
                ],
                [
                    'judul' => 'Jeddah - Jakarta',
                    'maskapai' => 'Turkish Airlines',
                    'tanggal_berangkat' => '2025-01-28',
                    'tanggal_tiba' => '2025-01-29',
                    'lama_penerbangan' => '15 jam',
                    'bagasi' => '35 kg',
                    'bagasi_kabin' => '8 kg',
                    'kursi' => 'Economy',
                    'bandara_asal' => 'King Abdulaziz',
                    'bandara_tujuan' => 'Soekarno-Hatta',
                    'kota_asal' => 'Jeddah',
                    'kota_tujuan' => 'Jakarta',
                ]
            ]),
            'akomodasi' => json_encode([
                [
                    'nama_hotel' => 'Crowne Plaza Istanbul',
                    'kota' => 'Istanbul',
                    'alamat' => 'Harbiye Mahallesi, Istanbul',
                    'tanggal_checkin' => '2025-01-16',
                    'tanggal_checkout' => '2025-01-19',
                    'rating' => 5
                ],
                [
                    'nama_hotel' => 'Pullman Zamzam Madinah',
                    'kota' => 'Madinah',
                    'alamat' => 'Central Area, Madinah',
                    'tanggal_checkin' => '2025-01-19',
                    'tanggal_checkout' => '2025-01-22',
                    'rating' => 5
                ],
                [
                    'nama_hotel' => 'Hilton Suites Makkah',
                    'kota' => 'Makkah',
                    'alamat' => 'Ibrahim Al Khalil Street, Makkah',
                    'tanggal_checkin' => '2025-01-22',
                    'tanggal_checkout' => '2025-01-28',
                    'rating' => 5
                ]
            ]),
        ]);



        sales::create([
            'kantor' => 'Perwakilan Jambi',
            'label' => 'Perwakilan',
            'nama' => 'Ibu Emy',
            'aktif' => true,
            'deskripsi' => 'Perwakilan dari PT. Air Zamzam',
        ]);
        sales::create([
            'kantor' => 'Patner',
            'label' => 'Patner',
            'nama' => 'Bapak Budi',
            'aktif' => true,
            'deskripsi' => 'Perwakilan dari PT. Air Zamzam',
        ]);
        sales::create([
            'kantor' => 'Kantor Pusat',
            'label' => 'Kantor',
            'nama' => 'Ajwa Expo',
            'aktif' => true,
            'deskripsi' => 'Kantor pusat Jambi Ajwa Expo',
        ]);
        sales::create([
            'kantor' => 'Kantor Pusat',
            'label' => 'Media Sosial',
            'nama' => 'Indtagram',
            'aktif' => true,
            'deskripsi' => 'Media sosial untuk promosi',
        ]);
    }
}
