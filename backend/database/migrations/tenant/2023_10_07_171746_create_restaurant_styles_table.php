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
            $table->unsignedBigInteger('user_id')->nullable(); // Ensure one style per user
            $table->string('logo_alignment')->nullable();
            $table->string('logo_shape')->nullable();
            $table->string('banner_type')->nullable();
            $table->string('banner_shape')->nullable();
            $table->string('banner_background_color')->nullable();
            $table->string('category_shape')->nullable();
            $table->string('category_hover_color')->nullable();
            $table->string('category_alignment')->nullable();
            $table->string('categoryDetail_type')->nullable();
            $table->string('categoryDetail_alignment')->nullable();
            $table->string('categoryDetail_shape')->nullable();
            $table->string('categoryDetail_cart_color')->nullable();
            $table->string('phoneNumber')->nullable();
            $table->string('phoneNumber_alignment')->nullable();
            $table->string('page_color')->nullable();
            $table->string('page_category_color')->nullable();
            $table->string('header_color')->nullable();
            $table->string('footer_color')->nullable();
            $table->string('price_color')->nullable();
            $table->json('selectedSocialIcons')->nullable();
            $table->string('text_fontFamily')->nullable();
            $table->string('text_fontWeight')->nullable();
            $table->string('text_fontSize')->nullable();
            $table->string('text_alignment')->nullable();
            $table->string('text_color')->nullable();

            $table->string('logo')->nullable();
            $table->string('banner_image')->nullable();
            $table->json('banner_images')->nullable();

            $table->timestamps();

             // Foreign key constraints
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
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
