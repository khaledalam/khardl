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
            $table->string('logo_alignment');
            $table->string('logo_shape');
            $table->string('banner_type');
            $table->string('banner_shape');
            $table->string('banner_background_color');
            $table->string('category_shape');
            $table->string('category_hover_color');
            $table->string('category_alignment');
            $table->string('categoryDetail_type');
            $table->string('categoryDetail_alignment');
            $table->string('categoryDetail_shape');
            $table->string('categoryDetail_cart_color');
            $table->string('phoneNumber');
            $table->string('phoneNumber_alignment');
            $table->string('page_color');
            $table->string('page_category_color');
            $table->string('header_color');
            $table->string('footer_color');
            $table->string('price_color');
            $table->json('selectedSocialIcons');
            $table->string('text_fontFamily');
            $table->string('text_fontWeight');
            $table->string('text_fontSize');
            $table->string('text_alignment');
            $table->string('text_color');

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
