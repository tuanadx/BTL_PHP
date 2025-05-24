<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('tac_gia', function (Blueprint $table) {
            $table->id();
            $table->string('ten_tac_gia');
            $table->string('email')->nullable();
            $table->string('sdt', 20)->nullable();
            $table->text('dia_chi')->nullable();
            $table->text('mo_ta')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('tac_gia');
    }
}; 