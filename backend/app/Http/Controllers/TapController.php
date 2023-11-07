<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TapController extends Controller
{

    public function payment(Request $request)
    {
        $payment = [
            "amount" => $request['amount'],
            "description" =>  '',
            "currency" => 'SAR',
            "receipt" => [
                "email" => true,
                "sms" => true
            ],
            "customer"=> [
                "first_name"=> Auth::user()->first_name,
                "last_name"=> Auth::user()->last_name,
                "email"=> Auth::user()->email,
                "phone"=> [
                    "country_code" => 'SA',
                    "number" => Auth::user()->phone_number
                ]
            ],
            "source"=> [
                "id"=> "src_all"
            ],
            "redirect"=> [
                "url"=> route('tap.callback')
            ]
        ];
        
        $curl = curl_init();
        curl_setopt_array($curl, array(
        CURLOPT_URL => "https://api.tap.company/v2/charges",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => json_encode($payment),
        CURLOPT_HTTPHEADER => array(
            "authorization: Bearer sk_test_XKokBfNWv6FIYuTMg5sLPjhJ", // SECRET API KEY
            "content-type: application/json"
        ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        $response = json_decode($response);

        return redirect($response->transaction->url);
    }

    public function callback(Request $request)
    {
        $input = $request->all();

        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => "https://api.tap.company/v2/charges/".$input['tap_id'],
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_POSTFIELDS => "{}",
        CURLOPT_HTTPHEADER => array(
                "authorization: Bearer sk_test_XKokBfNWv6FIYuTMg5sLPjhJ" // SECRET API KEY
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        $responseTap = json_decode($response);

        if ($responseTap->status == 'CAPTURED' && $responseTap->currency == "SAR") {
            
            $user = Auth::user();

            $pointsToAdd = $this->calculatePoints($responseTap->amount, $responseTap->currency);

            $userToSave = User::find($user->id);
            $userToSave->points += $pointsToAdd;
            $userToSave->total_points += $pointsToAdd;
            $userToSave->save();

            DB::table('orders')->insert([
                'order_id' => $responseTap->id,
                'user_id' => $user->id,
                'product_detail' => 'Points: ' . $pointsToAdd,
                'buyer_email' => $user->email,
                'restaurant_name' => $user->restaurant_name,
                'status' => 'COMPLETED',
                'date' => now(),
                'price' => $responseTap->amount,
            ]);

            return redirect()->route('tap.form')->with('success', 'Payment Successfully Made.');
            
        }

        

        return redirect()->route('tap.form')->with('error','Something Went Wrong.');
    }

    protected function calculatePoints($amount, $currency)
    {
        if($currency == "SAR"){
            if ($amount == 116.1) {
                return 90;
            } elseif ($amount == 387) {
                return 300;
            } elseif ($amount == 654.5) {
                return 550;
            } elseif ($amount == 742.50) {
                return 750;
            } elseif ($amount == 950.4) {
                return 990;
            } elseif ($amount == 1395) {
                return 1500;
            } elseif ($amount == 2640) {
                return 3000;
            } elseif ($amount == 4400) {
                return 5500;
            } elseif ($amount == 4550) {
                return 7000;
            }   
        }

        return 0;
    }
}
