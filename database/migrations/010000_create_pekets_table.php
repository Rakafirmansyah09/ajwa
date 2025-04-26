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
            $table->json('fasilitas')->nullable();
            $table->json('itinerary')->nullable();
            $table->text('detail');
            $table->timestamps();
        });

        Schema::create('group', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('paket_id');
            $table->string('nama');
            $table->json('jadwal_penerbangan')->nullable();
            $table->json('akomodasi')->nullable();
            $table->date('tanggal_keberangkatan');
            $table->date('tanggal_kepulangan')->nullable();
            $table->timestamps();

            $table->foreign('paket_id')->references('id')->on('pakets')->onDelete('cascade');
        });

        Schema::create('sales', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('label');
            $table->string('nama');
            $table->boolean('aktif');
            $table->text('deskripsi');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('group');
        Schema::dropIfExists('pakets');
        Schema::dropIfExists('sales');
    }
};
