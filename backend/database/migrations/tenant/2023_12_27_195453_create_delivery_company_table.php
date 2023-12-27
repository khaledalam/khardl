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
        Schema::create('delivery_company', static function (Blueprint $table) {
            $table->id();
            $table->json('name');
            $table->string('Module');
            $table->boolean('status')->default(false);
            $table->json('description')->nullable();
            $table->float('price', 8, 2)->default(0);
            $table->float('extra_price', 8, 2)->default(0);
            $table->float('coverage_km', 8, 2)->default(0);
            $table->string('contract_file')->nullable();
            $table->string('profile_file')->nullable();
            $table->string('api_doc_url')->nullable();
            $table->json('payments')->nullable();
            $table->string('api_key')->nullable();
            $table->string('secret_key')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('delivery_company');
    }
};
