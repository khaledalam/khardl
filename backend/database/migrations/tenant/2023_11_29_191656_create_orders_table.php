<?php

use App\Models\Tenant\Order;
use App\Models\Tenant\Payment;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('transaction_id')->unique()->nullable(); // This field is marked as unique to avoid duplicate entries
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('branch_id')->nullable();
            $table->unsignedBigInteger('payment_method_id')->nullable();
            $table->unsignedBigInteger('delivery_type_id')->nullable();
            $table->decimal('total', 8, 2)->default(0);
            $table->decimal('subtotal', 8, 2)->default(0);
            $table->decimal('delivery_cost', 8, 2)->default(0);
            $table->integer('vat')->default(15);
            $table->enum('status',Order::STATUS)->default(Order::PENDING);
            $table->string('payment_status')->default(Payment::PENDING);
            $table->text('shipping_address')->nullable();
            $table->text('order_notes')->nullable();


            // Foreign key constraints
            $table->foreign('payment_method_id')->references('id')->on('payment_methods')->onDelete('set null');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('delivery_type_id')->references('id')->on('delivery_types')->onDelete('set null');
            $table->foreign('branch_id')->references('id')->on('branches')->onDelete('set null');
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
