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
        Schema::create('news', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('judul');
            $table->string('gambar');
            $table->text('content');
            $table->string('author');
            $table->enum('status', ['draft', 'publish'])->default('draft');
            $table->date('tanggal_publish')->nullable();
            $table->timestamps();
        });


        Schema::create('faq', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('pertanyaan');
            $table->string('jawaban');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('news');
        Schema::dropIfExists('faq');
    }
};
