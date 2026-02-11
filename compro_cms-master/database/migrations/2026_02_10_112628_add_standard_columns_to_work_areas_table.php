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
        Schema::table('work_areas', function (Blueprint $table) {
            $table->string('kdkw', 10)->nullable()->after('wilayah_kerja')->comment('Kode Kantor Wilayah');
            $table->string('nama_kw', 100)->nullable()->after('kdkw')->comment('Nama Kantor Wilayah');
            $table->string('kdkc', 10)->nullable()->after('nama_kw')->comment('Kode Kantor Cabang');
            $table->string('nmkc', 100)->nullable()->after('kdkc')->comment('Nama Kantor Cabang');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('work_areas', function (Blueprint $table) {
            $table->dropColumn(['kdkw', 'nama_kw', 'kdkc', 'nmkc']);
        });
    }
};
