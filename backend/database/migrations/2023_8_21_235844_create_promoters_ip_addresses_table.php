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
        Schema::create('promoters_ip_addresses', function (Blueprint $table) {
            $table->unsignedBigInteger('promoter_id');
            $table->foreign('promoter_id')->references('id')->on('promoters')->onDelete('cascade');
            $table->string('ip_address');
            $table->boolean('registered')->default(false);
            $table->unique(['ip_address','promoter_id']);

            $table->timestamps();
        });

        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('promoters_ip_addresses');
    }
};
