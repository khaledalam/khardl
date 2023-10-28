<?php

namespace Database\Seeders\Tenant;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\ProductSize;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrderItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach(Order::get() as $order){
            OrderItem::create([
                'order_id'=>$order->id,
                'product_id'=>Product::inRandomOrder()->first()->id,
                'size_id'=>ProductSize::inRandomOrder()->first()->id,
                'quantity'=>fake()->randomNumber(1, true),
                'price'=>fake()->randomNumber(4,false),
                'created_at'=>now(),
                'updated_at'=>now(),
            ]);
        }
    }
}
