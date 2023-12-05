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
        Schema::create('items', function (Blueprint $table) {

            $table->id();
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('branch_id');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('photo');
            $table->decimal('price', 10, 2);
            $table->integer('calories');
            $table->json('description')->nullable();
            $table->json('checkbox_required')->nullable();
            $table->json('checkbox_input_titles')->nullable();
            $table->json('checkbox_input_maximum_choices')->nullable();
            $table->json('checkbox_input_names')->nullable();
            $table->json('checkbox_input_prices')->nullable();
            $table->json('selection_required')->nullable();
            $table->json('selection_input_names')->nullable();
            $table->json('selection_input_prices')->nullable();
            $table->json('selection_input_titles')->nullable();
            $table->json('dropdown_required')->nullable();
            $table->json('dropdown_input_titles')->nullable();
            $table->json('dropdown_input_names')->nullable();
            $table->boolean('availability')->default(true);
            $table->timestamps();

            $table->foreign('branch_id')->references('id')->on('branches');
            $table->foreign('category_id')->references('id')->on('categories');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('items');
    }
};
