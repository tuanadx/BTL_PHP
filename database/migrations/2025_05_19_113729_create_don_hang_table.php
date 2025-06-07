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
        Schema::create('don_hang', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_khach_hang')->constrained('khach_hang')->onDelete('cascade');
            $table->timestamp('ngay_dat_hang')->useCurrent();
            $table->decimal('tong_tien', 10, 2);
            $table->enum('trang_thai', ['cho_xu_ly', 'dang_giao', 'da_giao', 'da_huy'])->default('cho_xu_ly');
            $table->enum('trang_thai_thanh_toan', ['da_thanh_toan_vnpay', 'chua_thanh_toan', 'da_thanh_toan_khi_nhan_hang'])->default('chua_thanh_toan');
            $table->text('dia_chi');
            $table->string('sdt_nguoi_nhan', 20);
            $table->text('ghi_chu')->nullable();
            $table->string('ma_giao_dich_vnpay')->nullable();
            $table->string('ma_ngan_hang')->nullable();
            $table->timestamp('ngay_thanh_toan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('don_hang');
    }
};
