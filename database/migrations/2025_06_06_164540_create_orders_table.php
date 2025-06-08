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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')
                ->constrained() // otomatis mengacu ke tabel users dan kolom id
                ->onDelete('cascade');
            $table->foreignId('layanan_id')
                ->constrained('layanans') // mengacu ke tabel layanans kolom id
                ->onDelete('cascade');
            $table->integer('jumlah')->default(1);
            $table->string('status')->default('menunggu konfirmasi');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
