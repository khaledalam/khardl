<?php

namespace App\Http\Requests;

trait PhoneValidation
{
    public function validatePhone()  {
        if ($this->phone) {
            // Remove any non-digit characters
            $cleanedPhone = preg_replace('/\D/', '', $this->phone);

            if (strlen($cleanedPhone) === 9) {
                // If it's 10 digits, merge with '966'
                $this->merge(['phone' => '966' .$cleanedPhone]);
            }else if((strlen($cleanedPhone) === 10) && $cleanedPhone[0] == "0") {
                // If it's 9 digits, merge with '966'
                $this->merge(['phone' => '966' . substr($cleanedPhone,1)]);
            } elseif (strlen($cleanedPhone) === 12 && substr($cleanedPhone, 0, 3) === '966') {
                // If it's 12 digits and starts with '966', keep it
                $this->merge(['phone' => $cleanedPhone]);
            }
        }
    }
}
