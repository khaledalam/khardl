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
            $table->string('logo')->nullable();
            $table->enum('logo_alignment', ['left', 'center', 'right']);
            $table->string('category_style')->nullable();
            $table->json('banner_images')->nullable();
            $table->json('social_medias')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('primary_color')->nullable();
            $table->string('buttons_style')->nullable();
            $table->string('images_style')->nullable();
            $table->string('font_family')->nullable();
            $table->string('font_type')->nullable();
            $table->string('font_size')->nullable();
            $table->string('button1_name')->nullable();
            $table->string('button1_color')->nullable();
            $table->string('button2_name')->nullable();
            $table->string('button2_color')->nullable();
            $table->string('login_logo')->nullable();
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
