<?php

namespace App\Jobs;

use App\Enums\Admin\LogTypes;
use App\Mail\TAPLeadIDToMerchantIDRequest;
use App\Models\Log;
use App\Models\Tenant\RestaurantUser;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendTAPLeadIDMerchantIDRequestEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $user;
    protected $lead_id;

    /**
     * Create a new job instance.
     */
    public function __construct(RestaurantUser $user, string $lead_id)
    {
        $this->user = $user;
        $this->lead_id = $lead_id;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        try {
            // Send request email TAP lead id to merchant id
            Mail::send(new TAPLeadIDToMerchantIDRequest($this->lead_id));
            $action = [
                'en' => '[ok] Sent TAP lead id to merchant id email',
                'ar' => '[تم] ارسال بريد لتحويل lead الي merchant',
            ];
            tenancy()->central(function() use ($action) {
                Log::create([
                    'user_id' => $this?->user?->id,
                    'action' => $action,
                    'type' => LogTypes::TAPLeadIDMerchantIDSent,
                    'metadata' => [
                        'email' => $this?->user?->email ?? null,
                        'lead_id' => $this?->lead_id
                    ]
                ]);
            });

        } catch (\Exception $e) {
            $action = [
                'en' => '[fail] Sent TAP lead id to merchant id email',
                'ar' => '[فشل] ارسال بريد لتحويل lead الي merchant',
            ];
            tenancy()->central(function() use ($action) {
                Log::create([
                    'user_id' => $this?->user?->id,
                    'action' => $action,
                    'type' => LogTypes::TAPLeadIDMerchantIDFail,
                    'metadata' => [
                        'email' => $this?->user?->email ?? null,
                    ]
                ]);
            });
        }
    }
}
