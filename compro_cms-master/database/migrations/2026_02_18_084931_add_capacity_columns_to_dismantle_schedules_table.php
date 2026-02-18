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
        Schema::table('dismantle_schedules', function (Blueprint $table) {
            if (!Schema::hasColumn('dismantle_schedules', 'kapasitas')) {
                $table->integer('kapasitas')->default(0)->after('keterangan');
            }
            if (!Schema::hasColumn('dismantle_schedules', 'terpakai')) {
                $table->integer('terpakai')->default(0)->after('kapasitas');
            }
            if (!Schema::hasColumn('dismantle_schedules', 'status')) {
                $table->enum('status', ['open', 'full', 'closed'])->default('open')->after('terpakai');
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('dismantle_schedules', function (Blueprint $table) {
            $table->dropColumn(['kapasitas', 'terpakai', 'status']);
        });
    }
};
