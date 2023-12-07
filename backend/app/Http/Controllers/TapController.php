<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Utils\ResponseHelper;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Tenant\Tap\TapBusinessFile;
use App\Packages\TapPayment\File\File as TapFileAPI;
use App\Packages\TapPayment\Controllers\FileController;

class TapController extends Controller
{
    public function payments()
    {
        $user = Auth::user();
        return view('restaurant.payments', compact('user'));
    }

    public function payments_upload_tap_documents_get()
    {
        $user = Auth::user();
        $tap_files =TapBusinessFile::first();
        $files = [
            'business_logo' => 'Business Logo',
            'customer_signature' => 'Customer Signature',
            'dispute_evidence' => 'Dispute Evidence',
            'identity_document' => 'Identity Document',
            'pci_document' => 'PCI Document',
            'tax_document_user_upload' => 'TAX Document User Upload',
        ];
        return view('restaurant.payments_tap_create_business_upload_documents', compact('user','files','tap_files'));
    }

    public function payments_upload_tap_documents(Request $request)
    {
        // @TODO: handle upload tap documents logic here...
     
        $validationRules = [
            'business_logo' => 'required|mimes:jpeg,png,gif|file|max:8192',
            'customer_signature' => 'required|mimes:gif,jpeg,png,pdf|file|max:8192',
            'dispute_evidence' => 'required|mimes:jpeg,png,pdf|file|max:8192',
            'identity_document' => 'required|mimes:jpeg,png,pdf|file|max:8192',
            'pci_document' => 'required|mimes:jpeg,png,pdf|file|max:8192',
            'tax_document_user_upload' => 'required|mimes:jpeg,png,pdf|file|max:8192',
        ];
       
        $request->validate($validationRules);

        // Iterate through the keys
        $files = ['id'=>1];
        foreach ($validationRules as $key => $rule) {
            $file = $request->file($key);
            $title = ucwords(str_replace('_', ' ', $key));
            $response = TapFileAPI::create([
                'file'=>$file,
                'purpose'=>$key,
                'title'=>$title
            ]);
            if($response['http_code'] != ResponseHelper::HTTP_OK){
                return redirect()->back()->with('error', 'Failed to upload '.$title);
            }
            $files[$key.'_path'] = store_image($file,TapBusinessFile::STORAGE,$key);
            $files[$key.'_id'] =$response['message']['id'];
        }
        TapBusinessFile::updateOrCreate([
            'id'=>1
        ],$files);
    
        return redirect()->back()->with('success', 'Files successfully added.');

    }

    public function payments_submit_tap_documents_get()
    {
        $user = Auth::user();

        $tap_files_ids = [];

        return view('restaurant.payments_tap_create_business_submit_documents', compact('user'));
    }

    public function payments_submit_tap_documents(Request $request)
    {
        // @TODO: handle submit tap documents logic here...
        $user = Auth::user();

        return response()->json(['test' => 'ok']);
    }


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
