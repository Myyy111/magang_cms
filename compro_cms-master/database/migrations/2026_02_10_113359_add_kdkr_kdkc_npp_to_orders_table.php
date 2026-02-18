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
        Schema::table('orders', function (Blueprint $table) {
            if (!Schema::hasColumn('orders', 'kdkr')) {
                $table->string('kdkr', 10)->nullable()->after('customer_unit');
            }
            if (!Schema::hasColumn('orders', 'kdkc')) {
                $table->string('kdkc', 10)->nullable()->after('kdkr');
            }
            if (!Schema::hasColumn('orders', 'npp')) {
                $table->string('npp', 50)->nullable()->after('order_number');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn(['kdkr', 'kdkc', 'npp']);
        });
    }
};
