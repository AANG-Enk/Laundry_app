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
        Schema::create('pesanans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_layanan')->constrained(table: 'layanans',column: 'id');
            $table->foreignId('id_pelanggan')->constrained(table: 'pelanggans',column: 'id');
            // Petugas yang mencatat transaksi (relasi ke tabel users, konsisten dgn Modul 3)
            $table->unsignedBigInteger('id_user');
            $table->foreign('id_user')->references('id')->on('users');
            $table->decimal('berat_kg', 8, 2)->nullable();
            $table->integer('jumlah_item')->nullable();
            $table->decimal('total_harga', 12, 2);
            $table->date('tanggal_masuk');
            $table->date('estimasi_selesai');
            $table->enum('status', [
                'diterima',
                'proses_cuci',
                'proses_setrika',
                'siap_diambil',
                'selesai',
                'dibatalkan',
            ])->default('diterima');
            $table->text('catatan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pesanans');
    }
};
