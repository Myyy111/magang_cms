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
        if (!Schema::hasTable('dismantle_schedules')) {
            Schema::create('dismantle_schedules', function (Blueprint $table) {
                $table->id();
                $table->string('kode_wilayah')->nullable();
                $table->string('kode_cabang')->nullable();
                $table->date('tanggal')->nullable();
                $table->text('keterangan')->nullable();
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dismantle_schedules');
    }
};
