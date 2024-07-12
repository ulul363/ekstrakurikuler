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
        Schema::create('ekstrakurikulers', function (Blueprint $table) {
            $table->string('id_ekstrakurikuler', 5)->primary();
            $table->unsignedBigInteger('nip_pembina');
            $table->string('nama_ekstrakurikuler', 50)->nullable(false);
            $table->string('nama', 50);
            $table->foreign('nip_pembina')->references('nip_pembina')->on('pembinas')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ekstrakurikulers');
    }
};
