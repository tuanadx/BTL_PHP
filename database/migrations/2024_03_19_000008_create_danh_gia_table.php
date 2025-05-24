<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('danh_gia', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_sach')->constrained('sach')->cascadeOnDelete();
            $table->foreignId('id_khach_hang')->constrained('khach_hang')->cascadeOnDelete();
            $table->timestamp('thoi_gian_danh_gia')->useCurrent();
            $table->text('chi_tiet_danh_gia');
        });
    }

    public function down()
    {
        Schema::dropIfExists('danh_gia');
    }
}; 