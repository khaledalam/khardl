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
        Schema::create('restaurant_styles', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->unique(); // Ensure one style per user
            $table->string('logo');
            $table->string('logo_alignment');
            $table->string('category_style');
            $table->string('banner_style');
            $table->string('banner_image')->nullable();
            $table->json('banner_images')->nullable();
            $table->json('social_medias');
            $table->string('phone_number');
            $table->string('primary_color');
            $table->string('buttons_style');
            $table->string('images_style');
            $table->string('font_family');
            $table->string('font_type');
            $table->string('font_size');
            $table->string('font_alignment');
            $table->json('left_side_button');
            $table->json('right_side_button');
            $table->json('center_side_button');
    
     
            $table->timestamps();

             // Foreign key constraints
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('restaurant_styles');
    }
};
