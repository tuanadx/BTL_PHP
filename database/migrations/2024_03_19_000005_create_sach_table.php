<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('sach', function (Blueprint $table) {
            $table->id();
            $table->string('ten_sach');
            $table->decimal('gia_tien', 10, 2);
            $table->foreignId('id_tac_gia')->nullable()->constrained('tac_gia')->nullOnDelete();
            $table->string('ma_quoc_gia', 10)->nullable();
            $table->foreign('ma_quoc_gia')->references('ma_quoc_gia')->on('quoc_gia')->nullOnDelete();
            $table->unsignedInteger('ma_nxb')->nullable();
            $table->foreign('ma_nxb')->references('ma_nxb')->on('nha_xuat_ban')->nullOnDelete();
            $table->date('ngay_phat_hanh')->nullable();
            $table->text('gioi_thieu')->nullable();
            $table->integer('so_luong')->default(0);
            $table->string('anh')->nullable();
        });
    }

    public function down()
    {
        Schema::dropIfExists('sach');
    }
}; 