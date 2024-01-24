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
            $table->boolean("reminder_email_sent")->default(0);
            $table->boolean("reminder_suspend_email_sent")->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('r_o_subscriptions', function (Blueprint $table) {
            $table->dropColumn('reminder_email_sent');
            $table->dropColumn('reminder_suspend_email_sent');
        });
    }
};
