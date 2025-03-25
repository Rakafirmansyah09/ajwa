<?php

use App\Models\pembayaran;
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
        Schema::create('pembayarans', function (Blueprint $table) {
            $table->uuid('id')->primary(); // ID sebagai UUID
            $table->string('pendaftaran_id', 7); // Sesuaikan dengan id di tabel pendaftarans
            $table->decimal('harga', 10, 2);
            $table->string('bukti');
            $table->string('method');
            $table->string('key');
            $table->text('detail');
            $table->timestamps();

            // Foreign key constraint yang sesuai
            $table->foreign('pendaftaran_id')->references('id')->on('pendaftarans')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembayarans');
    }
};
