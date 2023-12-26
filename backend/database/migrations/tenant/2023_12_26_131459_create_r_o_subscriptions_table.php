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
        Schema::create('r_o_subscriptions', function (Blueprint $table) {
            $table->id();
            $table->string("card_id");
            $table->string("customer_id");
            $table->string('payment_agreement_id');
            $table->string('amount');
            $table->string('status');
            $table->string('public_key')->nullable();
            $table->string('secret_key')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('r_o_subscriptions');
    }
};
