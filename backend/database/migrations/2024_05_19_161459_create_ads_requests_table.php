<?php

use App\Enums\Admin\AdsRequestsStatusEnum;
use App\Models\AdvertisementPackage;
use App\Models\User;
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
        Schema::create('ads_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class)
            ->constrained()
            ->cascadeOnDelete()
            ->cascadeOnUpdate();
            $table->foreignIdFor(AdvertisementPackage::class)
            ->nullable()
            ->constrained()
            ->nullOnDelete()
            ->cascadeOnUpdate();
            $table->decimal('price',10,2)->default(0);
            $table->enum('status', AdsRequestsStatusEnum::values())->default(AdsRequestsStatusEnum::PENDING);
            $table->dateTime('answered_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ads_requests');
    }
};
