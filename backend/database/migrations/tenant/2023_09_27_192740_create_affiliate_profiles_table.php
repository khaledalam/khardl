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
        Schema::create('affiliate_profiles', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->decimal('commission_rate', 8, 2);
            $table->string('referral_code')->unique();
            $table->string('referral_link')->unique();
            $table->decimal('total_earned', 8, 2)->default(0.00);
            $table->enum('status', ['active', 'suspended', 'terminated'])->default('active');
            $table->text('payment_details')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('affiliate_profiles');
    }
};
