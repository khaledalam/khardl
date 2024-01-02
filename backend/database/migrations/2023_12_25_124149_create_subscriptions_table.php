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
        Schema::create('subscriptions', function (Blueprint $table) {
            $table->id();
            $table->enum("term",["DAIL", "WEEKLY", "MONTHLY", "BIMONTHLY", "QUARTERLY", "HALFYEARLY", "YEARLY"])->default('YEARLY');
            $table->integer('period')->default(1);
            $table->integer("due")->default(0);
            $table->boolean('auto_renew')->default(true);
            $table->integer("amount");

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subscriptions');
    }
};
