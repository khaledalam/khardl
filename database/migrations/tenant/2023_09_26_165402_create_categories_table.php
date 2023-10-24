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
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('restaurant_id');
            $table->json('name'); // Multilingual field
            $table->json('description')->nullable(); // Multilingual field
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->string('image_path')->nullable();
            $table->json('slug');
            $table->string('slug_value')->storedAs('JSON_UNQUOTE(JSON_EXTRACT(slug, "$.your_key"))')->unique();
            $table->integer('order')->default(0);
            $table->timestamps();

            $table->foreign('restaurant_id')->references('id')->on('restaurants')->onDelete('cascade');
            $table->foreign('parent_id')->references('id')->on('categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('categories', function (Blueprint $table) {
            // Drop the unique constraint and the generated column
            $table->dropUnique('categories_slug_value_unique');
            $table->dropColumn('slug_value');
        });
        Schema::dropIfExists('categories');
    }
};
