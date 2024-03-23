<?php

use App\Enums\Admin\CouponTypes;
use Doctrine\DBAL\Types\StringType;
use Doctrine\DBAL\Types\Type;
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
        try {
            Type::addType('enum', StringType::class);
        }catch(Throwable $e){}

        Schema::create('coupons', function (Blueprint $table) {
            $table->id();
            $table->enum('type', CouponTypes::values())->default(CouponTypes::FIXED_COUPON);
            $table->string('code');
            $table->decimal('amount',8,2);
            $table->integer('max_discount_amount')->nullable();
            $table->integer('max_use_per_user')->nullable();
            $table->integer('max_use')->nullable();
            $table->decimal('minimum_cart_amount',8,2)->nullable();
            $table->dateTime('active_from');
            $table->dateTime('expire_at');
            $table->boolean('status')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('coupons');
    }
};
