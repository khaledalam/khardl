<?php

use App\Models\Tenant\Branch;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->json('name'); // 
            $table->json('description')->nullable(); 
            $table->string('image_path')->nullable();
            $table->json('slug');
            $table->integer('sort_order')->default(0);
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->foreign('parent_id')->references('id')->on('categories')->onDelete('cascade');
            $table->foreignIdFor(Branch::class)
            ->constrained()
            ->cascadeOnDelete()
            ->cascadeOnUpdate();
            $table->timestamps();
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
