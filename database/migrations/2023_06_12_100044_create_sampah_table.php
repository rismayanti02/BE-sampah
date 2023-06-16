<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sampah', function (Blueprint $table) {
            $table->id();
            $table->string('kepala_keluarga');
            $table->integer('no_rumah');
            $table->string('rt_rw');
            $table->integer('total_karung_sampah');
            $table->enum('kriteria', ['standar', 'collapse'])->nullable();
            $table->date('tanggal_pengangkutan');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sampah');
    }
};
