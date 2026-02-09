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
        Schema::create('work_areas', function (Blueprint $table) {
            $table->id();
            
            // Wilayah Kerja - menggunakan ENUM untuk memastikan hanya nilai yang valid
            $table->enum('wilayah_kerja', ['kantor_pusat', 'kantor_wilayah', 'kantor_cabang'])
                  ->comment('Jenis wilayah kerja: kantor_pusat, kantor_wilayah, atau kantor_cabang');
            
            // Unit Kerja - informasi detail lokasi dan struktur organisasi
            $table->string('kab_kota', 100)
                  ->comment('Nama Kabupaten atau Kota tempat bekerja');
            
            $table->string('kantor_cabang', 150)
                  ->comment('Nama Kantor Cabang atau Asisten Deputi');
            
            $table->string('deputi_direktorat', 150)
                  ->comment('Nama Deputi, Direktorat, Bidang, atau Deputi Direktorat Wilayah');
            
            // Metadata - tracking siapa yang membuat dan mengubah data
            $table->unsignedBigInteger('created_by')->nullable()
                  ->comment('ID user yang membuat record');
            
            $table->unsignedBigInteger('updated_by')->nullable()
                  ->comment('ID user yang terakhir mengubah record');
            
            $table->timestamps();
            
            // Indexes untuk optimasi query
            $table->index('wilayah_kerja', 'idx_wilayah_kerja');
            $table->index('kab_kota', 'idx_kab_kota');
            $table->index('created_at', 'idx_created_at');
            
            // Foreign Keys (uncomment jika tabel users sudah ada)
            // $table->foreign('created_by')->references('id')->on('users')->onDelete('set null');
            // $table->foreign('updated_by')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('work_areas');
    }
};
