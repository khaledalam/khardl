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
        Schema::table('trader_requirements', function (Blueprint $table) {
            $table->string('IBAN')->nullable()->change();
            $table->string('facility_name')->nullable()->change();
            $table->string('commercial_registration')->nullable()->change();
            $table->string('bank_certificate')->nullable()->change();
            $table->string('identity_of_owner_or_manager')->nullable()->change();
            $table->string('national_address')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('trader_requirements', function (Blueprint $table) {
            //
        });
    }
};
