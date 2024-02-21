<?php

namespace Tests\Feature\Web\Tenant\Auth\Dashboard\Payment;

use App\Models\ROSubscription;
use App\Models\Tenant\Order;
use App\Models\Tenant\PaymentMethod;
use App\Models\Tenant\RestaurantUser;
use App\Models\Tenant\Setting;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Tests\TenantTestCase;



class PaymentPageTest extends TenantTestCase
{
    protected $tenancy = true;
    protected $user;
    private const path = "/payments";
    public function setUp(): void
    {
        parent::setUp();
        $this->user = $this->createUser();
        $role = Role::firstOrCreate(['name' => User::RESTAURANT_ROLE]);
        $this->user->assignRole($role);
        $this->actingAs($this->user, 'web');
    }
    public function createUser($options = null): RestaurantUser
    {
        return RestaurantUser::factory()->create($options);
    }
    public function createOrder($options = null): Order
    {
        return Order::factory()->create($options);
    }
    public function createSubscription($options = null): ROSubscription
    {
        return ROSubscription::factory()->create($options);
    }
    public function updateSetting($options)
    {
        $setting = Setting::first();
        $setting->update($options);
        return $setting->refresh();
    }
    public function test_payment_page_exist(): void
    {
        $response = $this->get(self::path);
        $response->isOk();
    }
    public function test_payment_page_redirection(): void
    {
        $order = $this->createOrder([
            'payment_method_id' => PaymentMethod::factory(['name' => 'Online'])
        ]);
        $response = $this->get(self::path);
        $response->assertSee('Redirecting to');
        $response->assertSee('tap-create-lead');
    }
    public function test_payment_has_orders(): void
    {
        $order = $this->createOrder([
            'payment_method_id' => PaymentMethod::factory(['name' => 'Online'])
        ]);
        $this->updateSetting([
            'lead_response' => '{"data:{1}"}',
            'merchant_id' => fake()->name,
            'lead_id' => fake()->name,
        ]);
        $response = $this->get(self::path);
        $response->isOk();
        $response->assertSee($order->shipping_address);
        $response->assertSee(__('Orders'));
    }
    public function test_payment_lead_response(): void
    {
        $this->updateSetting([
            'lead_response' => json_decode($this->constantLeadResponse()),
            'merchant_id' => fake()->name,
            'lead_id' => fake()->name,
        ]);
        $response = $this->get(self::path);
        $setting = Setting::first();
        $tap_response = $setting->lead_response;
        $this->assertNotEquals($tap_response['id'], null);
        $this->assertNotEquals($tap_response['brand'], null);
        $response->assertSee($tap_response['id']);
        $response->assertSee($tap_response['brand']['name']['ar']);
        $response->assertSee($tap_response['brand']['name']['ar']);
        $response->assertSee($tap_response['entity']['license']['number']);
        $response->assertSee($tap_response['entity']['license']['documents'][1]['number']);
        $response->assertSee($tap_response['entity']['license']['documents'][1]['issuing_date']);
        $response->assertSee($tap_response['entity']['license']['documents'][1]['expiry_date']);
        $response->assertSee($tap_response['user']['name']['first']);
        $response->assertSee($tap_response['user']['email'][0]['address']);
        $response->assertSee($tap_response['user']['phone'][0]['country_code']);
        $response->assertSee($tap_response['user']['phone'][0]['number']);
        $response->assertSee($tap_response['wallet']['bank']['name']);
        $response->assertSee($tap_response['wallet']['bank']['account']['iban']);
        $response->assertSee($tap_response['wallet']['bank']['account']['number']);
        $response->assertSee($tap_response['wallet']['bank']['account']['name']);
        $response->assertSee($tap_response['wallet']['bank']['documents'][0]['number']);
        $response->assertSee($tap_response['wallet']['bank']['documents'][0]['issuing_date']);
    }
    private function constantLeadResponse()
    {
        return '{
            "id": "led_bSKR6241639svy8qa1M481",
            "_token": "TkuRLK6YgBS5IuH53ahe065iIyhaJY0jKLbJ27Xr",
            "brand": {
                "name": {
                    "en": "test",
                    "ar": "test"
                },
                "logo": "file_656848322076980748",
                "channel_services": [
                    {
                        "channel": "website",
                        "address": "https://www.website.company/"
                    }
                ],
                "operations": {
                    "sales": {
                        "currency": "SAR"
                    }
                },
                "terms": [
                    {
                        "term": "general",
                        "agree": true
                    },
                    {
                        "term": "chargeback",
                        "agree": true
                    },
                    {
                        "term": "refund",
                        "agree": true
                    }
                ]
            },
            "entity": {
                "country": "SA",
                "is_licensed": true,
                "license": {
                    "number": "1010000000",
                    "country": "SA",
                    "type": "commercial_registration",
                    "documents": [
                        {
                            "type": "commercial_registration",
                            "number": "101000000",
                            "issuing_country": "SA",
                            "issuing_date": "2020-04-01",
                            "expiry_date": "2024-04-01"
                        },
                        {
                            "type": "Memorandum of Association",
                            "number": "000000000",
                            "issuing_country": "SA",
                            "issuing_date": "2019-07-09",
                            "expiry_date": "2021-07-09"
                        }
                    ]
                }
            },
            "wallet": {
                "bank": {
                    "name": "Ryiadh Bank",
                    "account": {
                        "name": "ABC",
                        "number": "77777777777",
                        "iban": "SA000000000000000009"
                    },
                    "documents": [
                        {
                            "type": "Bank Statement",
                            "number": "000000000",
                            "issuing_country": "SA",
                            "issuing_date": "2019-07-09",
                            "images": [
                                "file_643320430437906816"
                            ]
                        }
                    ]
                }
            },
            "user": {
                "name": {
                    "title": "Mr",
                    "first": "USER17",
                    "last": "MO"
                },
                "email": [
                    {
                        "type": "WORK",
                        "address": "user48@email.com",
                        "primary": true
                    }
                ],
                "phone": [
                    {
                        "type": "WORK",
                        "country_code": "966",
                        "number": "500000000",
                        "primary": true
                    }
                ],
                "post": {
                    "url": "http://merchant.company/post_url"
                },
                "metadata": {
                    "mtd": "metadata"
                },
                 "platforms": [
                    "commerce_platform_xxxxxxxxxx"
                ],
                "payment_provider": {
                    "settlement_by": "payment_facilitator_xxxxxxxxxxx",
                    "technology_id": "technology_xxxxxxxxxxxx"
                }
            }
        }';
    }
    public function test_has_subscription(): void
    {
        $this->updateSetting([
            'lead_response' => $this->constantLeadResponse(),
            'merchant_id' => fake()->name,
            'lead_id' => fake()->name,
        ]);
        //Assign subscription
        $subscription = $this->createSubscription([
            'user_id' => $this->user->id
        ]);
        $response = $this->get(self::path);
        $response->assertSee($subscription->number_of_branches);
        $response->assertSee($subscription->amount);
        $response->assertSee($subscription->subscription->name);
        $response->assertSee($subscription->start_at->format('Y-m-d'));
        $response->assertSee($subscription->end_at->format('Y-m-d'));

    }

}
