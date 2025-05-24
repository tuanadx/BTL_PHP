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
        Schema::create('nha_xuat_ban', function (Blueprint $table) {
            $table->increments('ma_nxb');
            $table->string('ten_nxb');
            $table->string('email')->nullable();
            $table->string('sdt', 20)->nullable();
            $table->text('dia_chi')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nha_xuat_ban');
    }
}; 