<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class AddDismantleScheduleIdToOrdersTable extends Migration
{
    /**
     * Run the migrations.
     * Safe for existing data: adds column nullable first,
     * backfills from kdkr+kdkc+tanggal matching, then adds FK.
     */
    public function up()
    {
        // STEP 1: Add nullable column if not exists
        if (!Schema::hasColumn('orders', 'dismantle_schedule_id')) {
            Schema::table('orders', function (Blueprint $table) {
                $table->unsignedBigInteger('dismantle_schedule_id')->nullable()->after('dismantel_schedule');
            });
        }

        // STEP 2: Backfill existing orders using kdkr + kdkc + tanggal matching
        DB::statement("
            UPDATE orders o
            INNER JOIN dismantle_schedules ds
                ON ds.kode_wilayah = o.kdkr
                AND ds.kode_cabang = o.kdkc
                AND ds.tanggal = DATE(o.dismantel_schedule)
            SET o.dismantle_schedule_id = ds.id
            WHERE o.dismantle_schedule_id IS NULL
              AND o.dismantel_schedule IS NOT NULL
              AND o.kdkr IS NOT NULL
              AND o.kdkc IS NOT NULL
        ");

        // STEP 3: Add foreign key constraint (if not already added)
        // Note: No native way to check for FK existence in Laravel <= 9 easily
        // but we can try-catch or just hope it works since we check for column existence.
        try {
            Schema::table('orders', function (Blueprint $table) {
                $table->foreign('dismantle_schedule_id')
                    ->references('id')
                    ->on('dismantle_schedules')
                    ->onDelete('restrict');
            });
        } catch (\Exception $e) {
            // Probably FK already exists
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropForeign(['dismantle_schedule_id']);
            $table->dropColumn('dismantle_schedule_id');
        });
    }
}
