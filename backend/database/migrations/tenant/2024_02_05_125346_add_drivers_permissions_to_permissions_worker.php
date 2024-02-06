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
        Schema::table('permissions_worker', function (Blueprint $table) {
            $table->boolean('can_edit_and_view_drivers')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('permissions_worker', function (Blueprint $table) {
            $table->dropColumn('can_edit_and_view_drivers');
        });
    }
};
