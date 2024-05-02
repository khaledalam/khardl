<?php

use App\Enums\Customer\AddressesTypeEnum;
use App\Models\Tenant\RestaurantUser;
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
        Schema::create('user_addresses', function (Blueprint $table) {
            $table->id();
            $table->string('address');
            $table->enum('type', AddressesTypeEnum::values())->default(AddressesTypeEnum::HOME);
            $table->string('lat')->nullable();
            $table->string('lng')->nullable();
            $table->boolean('default')->default(false);
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')
            ->references('id')
            ->on('users')
            ->onUpdate('cascade')
            ->onDelete('cascade');
            $table->timestamps();
        });
        /* Creating existing data */
        $customers = RestaurantUser::customers()->get();
        if($customers->count()){
            foreach ($customers as $customer) {
                if($customer->address && $customer->address !=null){
                    if(!$customer?->addresses()->count()){
                        $customer?->addresses()->create([
                            'address' => $customer->address,
                            'default' => true
                        ]);
                    }
                }
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_addresses');
    }
};
