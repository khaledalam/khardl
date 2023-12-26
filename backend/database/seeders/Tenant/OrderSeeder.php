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
        $status = Order::STATUS;
        for($i=0;$i<11;$i++){
            $order = Order::create([
                'user_id'=> RestaurantUser::find(UserSeeder::RESTAURANT_CUSTOMER_USER_ID)->id,
                'branch_id'=> Branch::first()->id,
                'transaction_id'=>fake()->unique()->uuid(),
                'total'=> fake()->randomNumber(4, true),
                'status'=>$status[array_rand($status)],
                "payment_method_id"=>PaymentMethod::inRandomOrder()->first()->id,
                'payment_status' => Order::PENDING,
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
                          "ar"=> [
                              "الاختيارات"=> [
                                  [
                                      "حار",
                                      "10"
                                  ],
                                  [
                                      "بارد",
                                      "10"
                                  ]
                              ]
                          ],
                          "en"=> [
                              "choices"=> [
                                  [
                                      "c1",
                                      "10"
                                  ],
                                  [
                                      "ac2",
                                      "10"
                                  ]
                              ]
                          ]
                      ],
                      [
                          "ar"=> [
                              "اختيارات ٢"=> [
                                  [
                                      "c2  value 1 ar",
                                      "1"
                                  ]
                              ]
                          ],
                          "en"=> [
                              "choices 2"=> [
                                  [
                                      "c2 value 1 en",
                                      "1"
                                  ]
                              ]
                          ]
                      ]
                  ],
                      "selection_options"=> [
                        [
                            "ar"=> [
                                "الأرز"=> [
                                    "١ كيلو",
                                    "10"
                                ]
                            ],
                            "en"=> [
                                "rice"=> [
                                    "1 kilo",
                                    "10"
                                ]
                            ]
                        ]
                          ],
                      "dropdown_options"=> [
                        [
                            "ar"=> [
                                "المقبلات "=> "اختيار ١"
                            ],
                            "en"=> [
                                "d1 en"=> "d1  value 1 en"
                            ]
                        ]
                        ]
                ]);
            }

        }
    }
}
