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
            $table->string('email')->unique()->nullable();
            $table->date('tanggal_lahir');
            $table->enum('jenis_kelamin', ['L', 'P']);
            $table->string('tempat_lahir');
            $table->string('file_ktp')->nullable();
            $table->string('file_paspor')->nullable();

            $table->uuid('id_akun')->nullable();
            $table->foreign('id_akun')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('pendaftaran', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('jemaah_id');
            $table->uuid('group_id');

            // kelengkapan data jemaah
            $table->string('no_hp');
            $table->integer('usia');
            $table->text('alamat');
            $table->string('kecamatan');

            // rombongan
            $table->uuid('id_rombongan')->nullable();

            // pembatalan
            $table->boolean('pembatalan')->default(false);
            $table->date('tanggal_pembatalan')->nullable();
            $table->text('alasan_pembatalan')->nullable();

            // sumber info
            $table->uuid('sumber_info')->nullable();
            $table->text('detail_info')->nullable();

            $table->timestamps();

            // Foreign key dengan tipe yang sesuai
            $table->foreign('sumber_info')->references('id')->on('sales')->onDelete('cascade');
            $table->foreign('jemaah_id')->references('id')->on('bioJemaahs')->onDelete('cascade');
            $table->foreign('group_id')->references('id')->on('group')->onDelete('cascade');
        });

        Schema::create('pembayarans', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('jemaah_id');
            $table->uuid('dibayar_oleh')->nullable();
            $table->decimal('harga', 10, 2);
            $table->string('bukti');
            $table->string('method');
            $table->string('key')->nullable();
            $table->enum('status', ['pending', 'success', 'failed'])->default('pending');
            $table->text('detail');
            $table->timestamps();

            // Foreign key constraint yang sesuai
            $table->foreign('jemaah_id')->references('id')->on('pendaftaran')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembayarans');
        Schema::dropIfExists('jemaah');
        Schema::dropIfExists('bioJemaahs');
    }
};
