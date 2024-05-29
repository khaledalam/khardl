<?php

use App\Enums\Order\TableInvoiceEnum;
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
        Schema::create('order_table_invoices', function (Blueprint $table) {
            $table->id();
            $table->integer("n_of_guests");
            $table->dateTime("date_time");
            $table->string("environment")->nullable()->comment('indoor , outdoor');
            $table->string("note")->nullable();
            $table->string("status")->default(TableInvoiceEnum::PENDING->value);
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
            $table->string('new_user')->nullable();
            $table->unsignedBigInteger('branch_id');
            $table->foreign('branch_id')->references('id')->on('branches')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_table_invoices');
    }
};
