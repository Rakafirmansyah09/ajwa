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
        Schema::create('bioJemaahs', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('nama_lengkap');
            $table->string('nik')->unique();
            $table->date('tanggal_lahir');
            $table->enum('jenis_kelamin', ['L', 'P']);
            $table->string('tempat_lahir');
            $table->string('file_ktp')->nullable();
            $table->string('file_paspor')->nullable();

            $table->timestamps();
        });

        Schema::create('rombongan', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('nama');
            $table->uuid('paket_keberangkatan_id');
            $table->timestamps();
        });

        Schema::create('jemaah', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('jemaah_id');
            $table->uuid('rombongan_id');

            // kelengkapan data jemaah
            $table->string('no_hp');
            $table->integer('usia');
            $table->text('alamat');
            $table->string('kecamatan');
            $table->string('file_kk');
            $table->string('file_foto');
            $table->string('file_ijazah');

            // sumber info
            $table->string('sumber_info')->nullable();
            $table->string('sumber_ket')->nullable();
            $table->text('detail_info')->nullable();

            $table->timestamps();

            // Foreign key dengan tipe yang sesuai
            $table->foreign('jemaah_id')->references('id')->on('bioJemaahs')->onDelete('cascade');
            $table->foreign('rombongan_id')->references('id')->on('rombongan')->onDelete('cascade');
        });

        Schema::create('pembayarans', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('rombongan_id');
            $table->decimal('harga', 10, 2);
            $table->string('bukti');
            $table->string('method');
            $table->string('key')->nullable();
            $table->enum('status', ['pending', 'success', 'failed'])->default('pending');
            $table->text('detail');
            $table->timestamps();

            // Foreign key constraint yang sesuai
            $table->foreign('rombongan_id')->references('id')->on('rombongan')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembayarans');
        Schema::dropIfExists('jemaah');
        Schema::dropIfExists('rombongan');
        Schema::dropIfExists('bioJemaahs');
    }
};
