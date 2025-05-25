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
    $table->string('nama_member');
    $table->string('email')->unique();
    $table->string('paket');
    $table->string('no_wa');
    $table->string('sosmed')->nullable();
    $table->text('catatan')->nullable();
    $table->foreignId('user_id')->constrained()->onDelete('cascade');
    $table->foreignId('paket_id')->constrained('pakets')->onDelete('cascade');
    $table->timestamps();
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
