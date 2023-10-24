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
        Schema::create('tags', function (Blueprint $table) {
            $table->id();
            $table->json('name');
            $table->json('slug');
            $table->string('name_value')->storedAs('JSON_UNQUOTE(JSON_EXTRACT(name, "$.your_key"))')->unique();
            $table->string('slug_value')->storedAs('JSON_UNQUOTE(JSON_EXTRACT(slug, "$.your_key"))')->unique();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tags', function (Blueprint $table) {
            // Drop the unique constraint and the generated column
            $table->dropUnique('tags_name_value_unique');
            $table->dropColumn('name_value');
            $table->dropUnique('tags_slug_value_unique');
            $table->dropColumn('slug_value');
        });
        Schema::dropIfExists('tags');
    }
};
