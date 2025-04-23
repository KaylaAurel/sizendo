<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('members', function (Blueprint $table) {
        $table->id();
        $table->string('nama_member'); // Nama lengkap member
        $table->string('email')->unique(); // Email member
        $table->string('paket'); // Paket yang dipilih (misalnya Netizen, Aktivis, Inisiator)
        $table->string('no_wa'); // Nomor WhatsApp
        $table->string('sosmed')->nullable(); // Sosial media (opsional)
        $table->text('catatan')->nullable(); // Catatan (opsional)
        $table->timestamps(); // Timestamps (created_at, updated_at)
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('members');
    }
};
