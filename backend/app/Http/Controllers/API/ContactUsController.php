<?php

namespace App\Http\Controllers\API;

use App\Enums\Admin\LogTypes;
use App\Jobs\SendContactUsEmailJob;
use App\Mail\ContactUsMail;
use App\Models\ContactUs;
use App\Models\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class ContactUsController extends BaseController
{
    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'email' => 'required|email|min:10|max:255',
            'phone_number' => 'required|string|min:10|max:255',
            'business_name' => 'required|string|min:5|max:255',
            'responsible_person_name' => 'required|string|min:3|max:255',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $contactUs = ContactUs::create($validator->validated());

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


        SendContactUsEmailJob::dispatch(
            email: $request->email,
            phone_number: $request->phone_number,
            business_name: $request->business_name,
            responsible_person_name: $request->responsible_person_name
        );

        // @TODO: remove Discord notification code
//        try {
//            $this->notifyDiscord($contactUs);
//        } catch (\Exception $e) {
//            $actions = [
//                'en' => 'Fail to send a new contact us form inputs to discord',
//                'ar' => 'فضل ارسال مدخل جديد من نمذج تواصل معنا الي discord'
//            ];
//            Log::create([
//                'user_id' => Auth::id(),
//                'action' => $actions,
//                'type' => LogTypes::ContactUsForm
//            ]);
//        }

        return $this->sendResponse(null, 'Contact information successfully submitted.');
    }

    private function notifyDiscord(ContactUs $contactUs): void
    {
        $webhook_url = env('CONTACT_US_DISCORD_WEBHOOK_URL', null);

        $data = "Name: " . $contactUs->email . "\n"
            . "Phone Number: " . $contactUs->phone_number . "\n"
            . "Business name: " . $contactUs->business_name . "\n"
            . "Responsible Person Name: " . $contactUs->responsible_person_name . "\n";
        $msg = ["content" => $data];

        $headers = array('Content-Type: application/json');

        $ch = curl_init();
        curl_setopt( $ch,CURLOPT_URL, $webhook_url );
        curl_setopt( $ch,CURLOPT_POST, true );
        curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
        curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
//        curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
        curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $msg ) );
        curl_exec( $ch );
        curl_close( $ch );
    }
}
