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
            $table->date("start_at");
            $table->date("end_at");
            $table->integer("amount");
            $table->integer("number_of_branches");
            $table->string("cus_id");
            $table->string("chg_id");
            $table->string("card_id")->nullable();
            $table->string("payment_agreement_id")->nullable();
            $table->string('subscription_id')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string("status")->default('active');
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
