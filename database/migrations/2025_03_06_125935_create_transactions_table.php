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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->string('token_trans')->unique();
            $table->foreignId('subscription_id')->constrained()->onDelete('cascade');
            $table->string('midtrans_transaction_id')->unique();
            $table->decimal('amount', 10, 2);
            $table->enum('status', ['pending', 'success', 'failed', 'refund']);
            $table->string('payment_type')->nullable();
            $table->timestamp('transaction_time');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
