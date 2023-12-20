<?php

namespace Database\Seeders\Tenant;

use App\Models\Tenant\Item;
use App\Models\Tenant\Order;
use App\Models\Tenant\Branch;
use App\Models\Tenant\DeliveryType;
use App\Models\Tenant\Setting;
use Illuminate\Database\Seeder;
use App\Models\Tenant\OrderItem;
use Illuminate\Http\UploadedFile;
use App\Models\Tenant\PaymentMethod;
use App\Models\Tenant\RestaurantUser;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $status = ['accepted','cancelled','pending'];
        for($i=0;$i<11;$i++){
            $order = Order::create([
                'user_id'=> RestaurantUser::find(UserSeeder::RESTAURANT_CUSTOMER_USER_ID)->id,
                'branch_id'=> Branch::first()->id,
                'transaction_id'=>fake()->unique()->uuid(),
                'total'=> fake()->randomNumber(4, true),
                'status'=>$status[array_rand($status)],
                "payment_method_id"=>PaymentMethod::inRandomOrder()->first()->id,
                'payment_status'=>"pending",
                'delivery_type_id'=>DeliveryType::inRandomOrder()->first()->id,
                'shipping_address'=>fake()->address(),
            ]);
            for ($j = 0; $j < 3; $j++) {
                $item = Item::inRandomOrder()->first();
                $quantity = fake()->numberBetween(1, 5);
                 OrderItem::create([
                    'order_id' => $order->id,
                    'item_id' => $item->id,
                    'quantity' => $quantity,
                    'price' => $item->price,
                    'total' => $item->price * $quantity,
                    'notes' => $item->notes,
                    "checkbox_options"=> [
                        [
                          "c1 ar"=> [
                            [
                              "c1 v1 ar",
                              "10"
                            ],
                            [
                              "c1 v2 ar",
                              "10"
                            ]
                          ],
                          "c1 en"=> [
                            [
                              "c1 v1 en",
                              "10"
                            ],
                            [
                              "c1 v2 en",
                              "10"
                            ]
                          ]
                        ],
                        [
                          "c2 ar"=> [
                            [
                              "c2 v1 ar",
                              "10"
                            ]
                          ],
                          "c2 en"=> [
                            [
                              "c2 v1 en",
                              "10"
                            ]
                          ]
                        ]
                      ],
                      "selection_options"=> [
                        [
                          "s1 ar"=> [
                            "s1 v1 ar",
                            "10"
                          ],
                          "s1 en"=> [
                            "s1 v1 en",
                            "10"
                          ]
                        ],
                        [
                          "s2 ar"=> [
                            "s2 v2 ar",
                            "10"
                          ],
                          "s2 en"=> [
                            "s2 v2 en",
                            "10"
                          ]
                        ]
                      ],
                      "dropdown_options"=> [
                        [
                          "d1 ar"=> "d1 v1 ar",
                          "d1 en"=> "d1 v1 en"
                        ],
                        [
                          "d2 ar"=> "d2 v1 ar",
                          "d2 en"=> "d2 v1 en"
                        ]
                      ]
                ]);
            }

        }
    }
}
