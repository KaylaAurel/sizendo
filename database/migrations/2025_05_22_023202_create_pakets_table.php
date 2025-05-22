<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaketsTable extends Migration
{
    public function up(): void
    {
        Schema::create('pakets', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // dulunya: nama_paket
            $table->text('description'); // dulunya: deskripsi
            $table->integer('price'); // dulunya: harga
            $table->integer('duration')->default(1); // TAMBAHAN: durasi (dalam bulan)
            $table->string('keterangan')->nullable(); // optional info tambahan
            $table->json('fitur'); // fitur-fitur paket
            $table->integer('urutan')->default(0); // urutan tampil
            $table->boolean('status')->default(true); // aktif/tidak
            $table->boolean('is_featured')->default(false); // apakah paket unggulan
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pakets');
    }
}
