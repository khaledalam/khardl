<?php

namespace App\Jobs;

use App\Mail\ApprovedRestaurant;
use App\Models\Log;
use App\Models\Tenant;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendApprovedRestaurantEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $restaurant;

    /**
     * Create a new job instance.
     */
    public function __construct(Tenant $restaurant)
    {
        $this->restaurant = $restaurant;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        try {
            Mail::to($this?->restaurant?->user?->email)->send(
                new ApprovedRestaurant($this?->restaurant?->user, $this?->restaurant)
            );

            Log::create([
                'restaurant_user_email' => $this?->restaurant?->user?->email,
                'action' => '[ok] Sent approve restaurant email',
                'user_id'=> $this?->restaurant?->user?->id
            ]);

        } catch(\Exception $e) {
            Log::create([
                'restaurant_user_email' => $this?->restaurant?->user?->email,
                'action' => '[fail] Send approve restaurant email',
                'user_id'=> $this?->restaurant?->user?->id
            ]);
        }
    }
}
