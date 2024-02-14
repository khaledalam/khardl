<?php

namespace Database\Factories\tenant;

use App\Models\ROSubscription;
use App\Models\Subscription;
use App\Models\Tenant\RestaurantUser;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ROSubscription>
 */
class ROSubscriptionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $subscription_id = null;
        tenancy()->central(function () use (&$subscription_id) {
            $subscription = Subscription::firstOrCreate([
                'name' => fake()->name,
                'amount' => fake()->numberBetween(100,1000),
                'description' => fake()->text
            ]);
            $subscription_id = $subscription->id;
        });
        return [
            "start_at" => now(),
            "end_at" => now(),
            'amount' => fake()->numberBetween(100,100),
            "number_of_branches" => fake()->numberBetween(1,10),
            "user_id" => RestaurantUser::factory(),
            'status' => fake()->randomElement(['active','deactivate','suspend']),
            'type' => fake()->randomElement(ROSubscription::TYPES),
            'reminder_email_sent' => fake()->boolean,
            'reminder_suspend_email_sent' => fake()->boolean,
            'subscription_id' => $subscription_id
        ];
    }
}
