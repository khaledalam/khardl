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
        Schema::create('customer_styles', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->unique(); // Ensure one style per user
            $table->string('primary_color')->nullable();
            $table->string('buttons_style')->nullable();
            $table->string('images_style')->nullable();
            $table->string('font_family')->nullable();
            $table->string('font_type')->nullable();
            $table->string('font_size')->nullable();
            $table->enum('font_alignment', ['left', 'center', 'right'])->default('left');
            $table->timestamps();

            // Foreign key constraint
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customer_styles');
    }
};
