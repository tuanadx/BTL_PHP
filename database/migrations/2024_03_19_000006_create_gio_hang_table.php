<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('gio_hang', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_khach_hang')->constrained('khach_hang')->cascadeOnDelete();
            $table->decimal('tong_tien', 10, 2)->default(0);
            $table->enum('trang_thai', ['active', 'temporary', 'completed'])->default('active');
            $table->text('ghi_chu')->nullable();
            $table->timestamp('ngay_tao')->useCurrent();
            $table->timestamp('ngay_cap_nhat')->useCurrent()->useCurrentOnUpdate();
        });
    }

    public function down()
    {
        Schema::dropIfExists('gio_hang');
    }
}; 