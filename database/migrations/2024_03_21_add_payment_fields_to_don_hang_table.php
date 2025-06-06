<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('don_hang', function (Blueprint $table) {
            $table->string('ma_giao_dich_vnpay')->nullable();
            $table->string('ma_ngan_hang')->nullable();
            $table->timestamp('ngay_thanh_toan')->nullable();
        });
    }

    public function down()
    {
        Schema::table('don_hang', function (Blueprint $table) {
            $table->dropColumn('ma_giao_dich_vnpay');
            $table->dropColumn('ma_ngan_hang');
            $table->dropColumn('ngay_thanh_toan');
        });
    }
}; 