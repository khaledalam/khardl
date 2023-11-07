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
            $table->unsignedBigInteger('user_id');
            $table->string('photo');
            $table->decimal('price', 10, 2);
            $table->integer('calories');
            $table->text('description')->nullable();
            $table->boolean('checkbox_required');
            $table->json('checkbox_input_titles');
            $table->json('checkbox_input_maximum_choices');
            $table->json('checkbox_input_names');
            $table->json('checkbox_input_prices');
            $table->boolean('selection_required');
            $table->json('selection_input_names');
            $table->json('selection_input_prices');
            $table->json('selection_input_titles');
            $table->boolean('dropdown_required');
            $table->json('dropdown_input_names');
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
