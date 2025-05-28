<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRememberTokenToKhachHangTable extends Migration
{
    public function up()
    {
        Schema::table('khach_hang', function (Blueprint $table) {
            $table->rememberToken()->after('role')->nullable();
        });
    }

    public function down()
    {
        Schema::table('khach_hang', function (Blueprint $table) {
            $table->dropColumn('remember_token');
        });
    }
}
