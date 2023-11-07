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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('restaurant_name')->nullable();
            $table->string('phone_number');
            $table->bigInteger('total_points')->default(0);
            $table->bigInteger('points')->default(0);
            $table->string('email')->unique();
            $table->string('password');
            $table->timestamp('email_verified_at')->nullable();
            $table->tinyInteger('isApproved')->default(0);
            $table->string('commercial_registration_pdf')->nullable();
            $table->string('signed_contract_delivery_company')->nullable();
            $table->string('tax_number')->nullable();
            $table->string('bank_certificate')->nullable();
            $table->date('website_expire')->nullable();
            $table->date('mobile_expire')->nullable();
            $table->string('branch_id')->nullabe();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
