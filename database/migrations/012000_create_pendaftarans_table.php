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
            $table->id();
            $table->foreignId('jemaah_id')->constrained();
            $table->foreignId('kategori_id')->constrained();
            $table->string('no_hp');
            $table->text('alamat');
            $table->string('kecamatan');
            $table->string('file_kk');
            $table->string('file_foto');
            $table->string('file_ijazah');

            $table->string('sumber_info')->nullable();
            $table->string('sumber_ket')->nullable();
            $table->text('detail_info')->nullable();

            $table->timestamps();
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
