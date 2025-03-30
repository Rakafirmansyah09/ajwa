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
        Schema::create('pendaftarans', function (Blueprint $table) {
            $table->string('id', 7)->primary(); // ID string 11 karakter
            $table->uuid('jemaah_id'); // Sesuaikan dengan UUID di jemaahs
            $table->string('kategori_id', 7); // Sesuaikan dengan ID string(7) di kategoris

            $table->string('no_hp');
            $table->integer('usia');
            $table->text('alamat');
            $table->string('kecamatan');
            $table->string('file_kk');
            $table->string('file_foto');
            $table->string('file_ijazah');

            $table->string('sumber_info')->nullable();
            $table->string('sumber_ket')->nullable();
            $table->text('detail_info')->nullable();

            $table->timestamps();

            // Foreign key dengan tipe yang sesuai
            $table->foreign('jemaah_id')->references('id')->on('jemaahs')->onDelete('cascade');
            $table->foreign('kategori_id')->references('id')->on('kategoris')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pendaftarans');
    }
};
