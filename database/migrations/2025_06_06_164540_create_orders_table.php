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
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('status')->default('pending');
            $table->string('payment_status')->nullable(); // e.g. settlement, pending, etc
            $table->string('payment_type')->nullable(); // credit_card, bank_transfer, etc
            $table->string('midtrans_order_id')->nullable(); // full Midtrans order_id
            $table->integer('gross_amount')->nullable();
            $table->timestamp('transaction_time')->nullable();
            $table->string('bukti_pembayaran')->nullable();
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
