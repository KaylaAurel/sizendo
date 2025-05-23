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
    Schema::table('admins', function ($table) {
        $table->string('api_token', 64)->nullable()->unique()->after('password');
    });
}

public function down()
{
    Schema::table('admins', function ($table) {
        $table->dropColumn('api_token');
    });
}

};
