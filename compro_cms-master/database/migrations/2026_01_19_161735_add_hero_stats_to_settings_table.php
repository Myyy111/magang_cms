<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddHeroStatsToSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->string('hero_stat_1_value')->nullable()->default('+24%');
            $table->string('hero_stat_1_label')->nullable()->default('Growth');
            $table->string('hero_stat_2_value')->nullable()->default('Verified');
            $table->string('hero_stat_2_label')->nullable()->default('Security');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->dropColumn(['hero_stat_1_value', 'hero_stat_1_label', 'hero_stat_2_value', 'hero_stat_2_label']);
        });
    }
}
