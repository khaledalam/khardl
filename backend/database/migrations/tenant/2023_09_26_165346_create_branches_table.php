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
        Schema::create('branches', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->double('lat', 8, 2);
            $table->double('lng', 8, 2);
            $table->time('monday_open');
            $table->time('monday_close');
            $table->boolean('monday_closed')->default(false);

            $table->time('tuesday_open');
            $table->time('tuesday_close');
            $table->boolean('tuesday_closed')->default(false);

            $table->time('wednesday_open');
            $table->time('wednesday_close');
            $table->boolean('wednesday_closed')->default(false);

            $table->time('thursday_open');
            $table->time('thursday_close');
            $table->boolean('thursday_closed')->default(false);

            $table->time('friday_open');
            $table->time('friday_close');
            $table->boolean('friday_closed')->default(false);

            $table->time('saturday_open');
            $table->time('saturday_close');
            $table->boolean('saturday_closed')->default(false);

            $table->time('sunday_open');
            $table->time('sunday_close');
            $table->boolean('sunday_closed')->default(false);

            $table->boolean('is_primary')->default(false);
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('branches');
    }
};
