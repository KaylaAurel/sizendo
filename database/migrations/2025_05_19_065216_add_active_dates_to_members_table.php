<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('members', function (Blueprint $table) {
            $table->boolean('is_active')->default(false); // status aktif
            $table->date('start_date')->nullable();       // tanggal mulai aktif
            $table->date('end_date')->nullable();         // tanggal berakhir keanggotaan
        });
    }

    public function down(): void
    {
        Schema::table('members', function (Blueprint $table) {
            $table->dropColumn(['is_active', 'start_date', 'end_date']);
        });
    }
};
