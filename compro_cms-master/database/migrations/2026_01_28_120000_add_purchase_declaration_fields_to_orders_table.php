<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->string('wilayah_kerja')->nullable();
            $table->string('unit_kerja_type')->nullable(); // Kab/Kota, Cabang, Deputi
            $table->string('unit_kerja_detail')->nullable();
            $table->string('user_status')->nullable(); // Pengguna Sewa / Bukan
            $table->string('laptop_serial_number')->nullable();
            $table->string('payment_mechanism')->nullable(); // Transfer / Potong Gaji
            $table->integer('payroll_deduction_periods')->nullable(); // 1, 2, 3, 4
            $table->string('signed_document_path')->nullable();
        });
    }

    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn([
                'wilayah_kerja',
                'unit_kerja_type',
                'unit_kerja_detail',
                'user_status',
                'laptop_serial_number',
                'payment_mechanism',
                'payroll_deduction_periods',
                'signed_document_path'
            ]);
        });
    }
};
