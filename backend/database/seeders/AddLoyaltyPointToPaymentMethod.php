<?php

namespace Database\Seeders;

use Exception;
use App\Models\Tenant;
use App\Models\Tenant\PaymentMethod;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AddLoyaltyPointToPaymentMethod extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $restaurants = Tenant::all();
        DB::beginTransaction();
        foreach($restaurants as $restaurant){
            try {
                $restaurant->run(function(){
                    PaymentMethod::firstOrCreate([
                        'name' => PaymentMethod::LOYALTY_POINTS
                    ]);
                });
             
            }catch(Exception $e){
                DB::rollBack();
                \Sentry\captureException($e);
            }
           
        }
        DB::commit();
    }
}
