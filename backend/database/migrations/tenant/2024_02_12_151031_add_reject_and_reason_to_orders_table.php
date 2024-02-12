<?php

use App\Models\Tenant\Order;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Doctrine\DBAL\Types\Type;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::statement("ALTER TABLE orders MODIFY COLUMN status ENUM('" . implode("','", Order::STATUS) . "') DEFAULT 'pending' NOT NULL");

        Schema::table('orders', function (Blueprint $table) {
            $table->text('reject_or_cancel_reason')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn(['reject_or_cancel_reason']);
        });
    }
};
