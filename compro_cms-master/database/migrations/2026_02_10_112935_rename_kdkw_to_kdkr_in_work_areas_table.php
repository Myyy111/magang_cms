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
        if (Schema::hasColumn('work_areas', 'kdkw') && !Schema::hasColumn('work_areas', 'kdkr')) {
            // Use DB statement to support older MySQL versions (< 8.0)
            // that do not support RENAME COLUMN syntax used by Laravel's renameColumn
            try {
                Schema::table('work_areas', function (Blueprint $table) {
                    $table->renameColumn('kdkw', 'kdkr');
                });
            } catch (\Exception $e) {
                DB::statement("ALTER TABLE work_areas CHANGE kdkw kdkr VARCHAR(10) NULL COMMENT 'Kode Kantor Wilayah'");
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasColumn('work_areas', 'kdkr') && !Schema::hasColumn('work_areas', 'kdkw')) {
            try {
                Schema::table('work_areas', function (Blueprint $table) {
                    $table->renameColumn('kdkr', 'kdkw');
                });
            } catch (\Exception $e) {
                DB::statement("ALTER TABLE work_areas CHANGE kdkr kdkw VARCHAR(10) NULL COMMENT 'Kode Kantor Wilayah'");
            }
        }
    }
};
