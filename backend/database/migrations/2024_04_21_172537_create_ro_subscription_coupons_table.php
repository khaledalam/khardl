<?php

use App\Enums\Admin\CouponTypes;
use App\Enums\Admin\SubscriptionTypes;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('ro_subscription_coupons', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->decimal('amount',8,2);
            $table->boolean('is_application_purchase');
            $table->boolean('is_branch_purchase');
            $table->enum('type', CouponTypes::values())->default(CouponTypes::FIXED_COUPON);
            $table->integer('max_use')->nullable();
            $table->integer('n_of_usage')->default(0);
            $table->unsignedBigInteger('promoter_id')->unique();
            $table->foreign('promoter_id')->references('id')->on('promoters')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ro_subscription_coupons');
    }
};
