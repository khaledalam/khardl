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
        Schema::create('survey_responses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->boolean('has_mobile_app');
            $table->boolean('has_delivery_system')->nullable();
            $table->boolean('has_own_deliveries')->nullable();
            $table->boolean('use_delivery_app')->nullable();
            $table->boolean('sign_contract_with_delivery')->nullable();
            $table->boolean('has_cashier_system');
            $table->boolean('use_order_app')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('survey_responses');
    }
};
