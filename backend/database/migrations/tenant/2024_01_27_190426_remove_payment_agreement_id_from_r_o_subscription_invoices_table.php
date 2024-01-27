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
        Schema::table('r_o_subscription_invoices', function (Blueprint $table) {
            $table->dropColumn('payment_agreement_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('r_o_subscription_invoices', function (Blueprint $table) {
            $table->string("payment_agreement_id")->nullable();
        });
    }
};
