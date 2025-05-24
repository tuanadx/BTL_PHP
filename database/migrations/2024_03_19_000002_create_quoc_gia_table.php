<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('quoc_gia', function (Blueprint $table) {
            $table->string('ma_quoc_gia', 10)->primary();
            $table->string('ten_quoc_gia', 100);
        });
    }

    public function down()
    {
        Schema::dropIfExists('quoc_gia');
    }
}; 