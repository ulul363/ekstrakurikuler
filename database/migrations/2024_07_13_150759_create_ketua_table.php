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
        Schema::create('ketua', function (Blueprint $table) {
            $table->id('id_ketua');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('ekstrakurikuler_id');
            $table->string('nis', 20)->unique();
            $table->string('nama', 50);
            $table->string('alamat', 50);
            $table->enum('jk', ['L', 'P']);
            $table->string('no_hp', 15);
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onUpdate('restrict')->onDelete('restrict');
            $table->foreign('ekstrakurikuler_id')->references('id_ekstrakurikuler')->on('ekstrakurikuler')->onUpdate('restrict')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ketua');
    }
};
