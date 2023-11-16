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
        Schema::create('permissions_worker', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('user_id');

            $table->boolean('can_edit_menu')->default(false);
            $table->boolean('can_modify_advertisements')->default(false);
            $table->boolean('can_modify_and_see_other_workers')->default(false);
            $table->boolean('can_modify_working_time')->default(false);
            $table->boolean('can_control_payment')->default(false);

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('permissions_worker');
    }
};
