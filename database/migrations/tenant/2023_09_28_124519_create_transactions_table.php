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
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('payment_id')->nullable(); // It's nullable because not all transactions might be tied to a payment
            $table->enum('transaction_type', ['payment', 'refund', 'withdrawal', 'deposit']);
            $table->decimal('amount', 15, 2);
            $table->string('currency', 3);
            $table->enum('status', ['completed', 'pending', 'failed']);
            $table->timestamp('transaction_date');
            $table->string('external_reference')->nullable();
            $table->json('details')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('payment_id')->references('id')->on('payments')->onDelete('set null');
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
