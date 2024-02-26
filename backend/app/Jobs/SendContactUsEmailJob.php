<?php

namespace App\Jobs;

use App\Enums\Admin\LogTypes;
use App\Mail\ContactUsMail;
use App\Models\Log;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class SendContactUsEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public string $email;
    public string $phone_number;
    public string $business_name;
    public string $responsible_person_name;

    /**
     * Create a new message instance.
     *
     * @param string $lead_id
     * @return void
     */
    public function __construct(
        string $email,
        string $phone_number,
        string $business_name,
        string $responsible_person_name
    )
    {
        $this->email = $email;
        $this->phone_number = $phone_number;
        $this->business_name = $business_name;
        $this->responsible_person_name = $responsible_person_name;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        try {
            Mail::send(new ContactUsMail(
                email: $this->email,
                phone_number: $this->phone_number,
                business_name: $this->business_name,
                responsible_person_name: $this->responsible_person_name
            ));
            $actions = [
                'en' => 'Received a new contact us form inputs',
                'ar' => 'استقبال مدخل جديد من نمذج تواصل معنا'
            ];
            Log::create([
                'user_id' => Auth::id(),
                'action' => $actions,
                'type' => LogTypes::ContactUsForm,
                'meta' => json_encode($contactUs)
            ]);

        } catch (\Exception $e) {
            $actions = [
                'en' => 'Fail to send contact us form inputs',
                'ar' => 'فشل مدخل جديد من نمذج تواصل معنا'
            ];
            Log::create([
                'user_id' => Auth::id(),
                'action' => $actions,
                'type' => LogTypes::ContactUsForm,
                'meta' => json_encode($contactUs)
            ]);
        }
    }
}
