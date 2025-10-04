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
        Schema::create('mata_kuliah', function (Blueprint $table) {
           $table->id();
            $table->string('kode_mk')->unique();
            $table->string('nama_mk');
            $table->unsignedTinyInteger('sks'); // jumlah SKS (1-9 biasanya)
            $table->unsignedBigInteger('dosen_id'); // relasi ke tabel users (dosen)
            $table->timestamps();

            $table->foreign('dosen_id')->references('id')->on('users')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mata_kuliah');
    }
};
