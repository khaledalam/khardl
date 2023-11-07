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
        Schema::create('permissions', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('user_id');

            $table->boolean('can_access_dashboard')->default(false);
            $table->boolean('can_access_restaurants')->default(false);
            $table->boolean('can_view_restaurants')->default(false);
            $table->boolean('can_delete_restaurants')->default(false);
            $table->boolean('can_approve_restaurants')->default(false);
            $table->boolean('can_see_admins')->default(false);
            $table->boolean('can_add_admins')->default(false);
            $table->boolean('can_edit_admins')->default(false);
            $table->boolean('can_promoters')->default(false);
            $table->boolean('can_see_logs')->default(false);
            $table->boolean('can_settings')->default(false);
            $table->boolean('can_edit_profile')->default(false);
            
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('permissions');
    }
};
