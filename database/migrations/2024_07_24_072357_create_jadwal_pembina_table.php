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
        Schema::create('jadwal_pembina', function (Blueprint $table) {
            $table->id('id_jadwal_pembina');
            $table->unsignedBigInteger('pembina_id');
            $table->string('hari');
            $table->time('waktu_mulai');
            $table->time('waktu_selesai');
            $table->enum('status', ['tersedia', 'tidak tersedia'])->default('tersedia');
            $table->timestamps();

            $table->foreign('pembina_id')->references('id_pembina')->on('pembina')->onUpdate('restrict')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jadwal_pembina');
    }
};
