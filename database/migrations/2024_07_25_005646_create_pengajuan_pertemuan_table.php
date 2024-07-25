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
        Schema::create('pengajuan_pertemuan', function (Blueprint $table) {
            $table->id('id_pengajuan_pertemuan');
            $table->unsignedBigInteger('ketua_id');
            $table->unsignedBigInteger('pembina_id');
            $table->date('tanggal');
            $table->time('waktu_mulai');
            $table->time('waktu_selesai');
            $table->enum('status', ['tersedia', 'tidak tersedia']);
            $table->timestamps();

            $table->foreign('ketua_id')->references('id_ketua')->on('ketua')->onUpdate('restrict')->onDelete('restrict');
            $table->foreign('pembina_id')->references('id_pembina')->on('pembina')->onUpdate('restrict')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengajuan_pertemuan');
    }
};
