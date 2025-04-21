<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pakets', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('nama');
            $table->string('gambar')->nullable();
            $table->string('code')->unique();
            $table->integer('durasi');
            $table->decimal('harga', 10, 2);
            $table->integer('kuota');
            $table->text('detail');
            $table->timestamps();
        });

        Schema::create('group', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('paket_id');
            $table->string('nama');
            $table->date('tanggal_keberangkatan');
            $table->date('tanggal_kepulangan')->nullable();
            $table->timestamps();

            $table->foreign('paket_id')->references('id')->on('pakets')->onDelete('cascade');
        });


        // jadwal_penerbangan
        Schema::create('jadwal_penerbangan', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('group_id');
            $table->string('judul');
            $table->string('maskapai');
            $table->dateTime('tanggal_berangkat');
            $table->dateTime('tanggal_tiba')->nullable();
            $table->integer('lama_penerbangan');
            $table->integer('bagasi');
            $table->integer('bagasi_kabin');
            $table->string('kursi');
            $table->string('bandara_asal');
            $table->string('kota_bandara_asal');
            $table->string('bandara_tujuan');
            $table->string('kota_bandara_tujuan');
            $table->timestamps();

            $table->foreign('group_id')->references('id')->on('group')->onDelete('cascade');
        });

        // akomodasi
        Schema::create('akomodasi', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('group_id');
            $table->string('nama_hotel');
            $table->string('kota');
            $table->text('alamat')->nullable();
            $table->date('tanggal_checkin');
            $table->date('tanggal_checkout');
            $table->integer('rating');
            $table->timestamps();

            $table->foreign('group_id')->references('id')->on('group')->onDelete('cascade');
        });

        // itinerary
        Schema::create('itinerary', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('paket_id');
            $table->date('tanggal');
            $table->string('judul_kegiatan');
            $table->text('deskripsi')->nullable();
            $table->string('lokasi')->nullable();
            $table->timestamps();

            $table->foreign('paket_id')->references('id')->on('pakets')->onDelete('cascade');
        });

        // fasilitas
        Schema::create('fasilitas', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('paket_id');
            $table->string('nama_fasilitas');
            $table->timestamps();

            $table->foreign('paket_id')->references('id')->on('pakets')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fasilitas');
        Schema::dropIfExists('itinerary');
        Schema::dropIfExists('akomodasi');
        Schema::dropIfExists('jadwal_penerbangan');
        Schema::dropIfExists('group');
        Schema::dropIfExists('pakets');
    }
};
