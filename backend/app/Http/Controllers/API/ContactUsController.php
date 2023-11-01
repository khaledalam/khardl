<?php

namespace App\Http\Controllers\API;

use App\Models\ContactUs;
use Illuminate\Http\Request;
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
        try{
            Mail::send('emails.contact', [
                'contact_id'=>$contactUs->id,
                'email' => $request->email,
                'phone_number' =>$request->phone_number,
                'business_name' => $request->business_name,
                'responsible_person_name' =>$request->responsible_person_name,
            ], static function($message)  {
                $message->to(env("MAIL_CONTACT_USERNAME",'contact-us@khardl.com'));
                $message->subject('New Contact Form');
            });
        } catch (\Exception $e){
            logger($e->getMessage());
        }

        return $this->sendResponse(null, 'Contact information successfully submitted.');
    }
}
