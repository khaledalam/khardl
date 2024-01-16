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
        Schema::table('r_o_subscriptions', function (Blueprint $table) {
            $table->dropColumn('cus_id');
            $table->dropColumn('chg_id');
            $table->dropColumn('card_id');
            $table->dropColumn('payment_agreement_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('r_o_subscriptions', function (Blueprint $table) {
            $table->string("cus_id");
            $table->string("chg_id");
            $table->string("card_id")->nullable();
            $table->string("payment_agreement_id")->nullable();
        });
    }
};
