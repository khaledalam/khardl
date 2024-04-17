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
        Schema::create('notification_receipts', function (Blueprint $table) {
            $table->id();
            $table->string('email');
            $table->string('name');
            $table->boolean('active')->default(true);
            $table->boolean('is_application_purchase')->default(false);
            $table->boolean('is_branch_purchase')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notification_receipts');
    }
};
