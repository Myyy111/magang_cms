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
    Schema::table('members', function (Blueprint $table) {
        if (!Schema::hasColumn('members', 'kategori')) {
            $table->string('kategori')->nullable(); // direksi, komisaris, head_unit
        }
    });
}

public function down()
{
    Schema::table('members', function (Blueprint $table) {
        $table->dropColumn('kategori');
    });
}
};
