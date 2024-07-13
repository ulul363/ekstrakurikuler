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
        Schema::create('pembina', function (Blueprint $table) {
            $table->id('id_pembina');
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('ekstrakurikuler_id')->constrained('ekstrakurikuler');
            $table->string('nip', 20)->unique();
            $table->string('nama', 50);
            $table->string('alamat', 50);
            $table->enum('jk', ['L', 'P']);
            $table->string('no_hp', 15);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembina');
    }
};