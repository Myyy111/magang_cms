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
        Schema::table('orders', function (Blueprint $table) {
            if (!Schema::hasColumn('orders', 'npp')) {
                $table->string('npp')->nullable()->after('customer_id_num');
            }
            if (!Schema::hasColumn('orders', 'kdkr')) {
                $table->string('kdkr')->nullable()->after('status');
            }
            if (!Schema::hasColumn('orders', 'kdkc')) {
                $table->string('kdkc')->nullable()->after('kdkr');
            }
            if (!Schema::hasColumn('orders', 'dismantle_schedule_id')) {
                $table->unsignedBigInteger('dismantle_schedule_id')->nullable()->after('esign_path');
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
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn(['npp', 'kdkr', 'kdkc', 'dismantle_schedule_id']);
        });
    }
};
