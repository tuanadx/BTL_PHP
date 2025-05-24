<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('chi_tiet_gio_hang', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_gio_hang')->constrained('gio_hang')->cascadeOnDelete();
            $table->foreignId('id_sach')->constrained('sach')->cascadeOnDelete();
            $table->integer('so_luong')->default(1);
            $table->decimal('gia_tien', 10, 2);
            $table->decimal('thanh_tien', 10, 2)->storedAs('so_luong * gia_tien');
            $table->timestamp('ngay_them')->useCurrent();
        });
    }

    public function down()
    {
        Schema::dropIfExists('chi_tiet_gio_hang');
    }
}; 