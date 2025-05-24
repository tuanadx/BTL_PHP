<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('khach_hang', function (Blueprint $table) {
            $table->id();
            $table->string('ho_ten', 100);
            $table->string('email', 100)->unique();
            $table->string('mat_khau');
            $table->string('so_dien_thoai', 20)->nullable();
            $table->text('dia_chi')->nullable();
            $table->date('ngay_sinh')->nullable();
            $table->enum('gioi_tinh', ['Nam', 'Nữ', 'Khác'])->nullable();
            $table->timestamp('ngay_dang_ky')->useCurrent();
            $table->boolean('trang_thai')->default(1)->comment('1: Hoạt động, 0: Khóa');
            $table->integer('role')->default(1);
        });
    }

    public function down()
    {
        Schema::dropIfExists('khach_hang');
    }
}; 