<?php

namespace App\Http\Controllers;

use App\Mail\ApprovedBusiness;
use App\Models\User;
use LVR\CountryCode\Two;
use Illuminate\Http\Request;
use App\Utils\ResponseHelper;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Models\Tenant\Tap\TapBusiness;
use App\Models\Tenant\Tap\TapBusinessFile;
use App\Packages\TapPayment\Business\Business;
use App\Packages\TapPayment\File\File as TapFileAPI;
use App\Packages\TapPayment\Controllers\FileController;
use App\Packages\TapPayment\Requests\CreateBusinessRequest;

class TapController extends Controller
{
    public function payments()
    {
        $user = Auth::user();
        $business = TapBusiness::first();
        return view('restaurant.payments', compact('user','business'));
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
    
        return redirect()->route("tap.payments_submit_tap_documents_get")->with('success', __('Files successfully added.'));

    }

    public function payments_submit_tap_documents_get()
    {
        $user = Auth::user();

        $tap_files_ids = [];

        return view('restaurant.payments_tap_create_business_submit_documents', compact('user'));
    }

    public function payments_submit_tap_documents(CreateBusinessRequest $request)
    { 
       

        $user= Auth::user();
       
        $data = $request->validated();
        $files = TapBusinessFile::first();
        $types = [
            'business_logo_id',
            'customer_signature_id',
            'dispute_evidence_id',
            'pci_document_id',
            'tax_document_user_upload_id',
        ];
        foreach($types as $id){
            $data['entity']['documents'][] = [
                'type'=>"License",
                "files"=> [
                    $files->{$id}
                ]
            ];
        }
        $user = Auth::user();
        $business = Business::create($data);
        if($business['http_code'] != ResponseHelper::HTTP_OK){
            return redirect()->back()
            ->withErrors([
                __('Failed to create business'),
                $business['message']
            ])
            ->withInput($request->input());
        }
       
        TapBusiness::create([
            'data'=>$data,
            'business_id'=>$business['message']['id'],
            "destination_id"=>$business['message']['destination_id'],
            "status"=>$business['message']['status'],
            "entity_id"=>$business['message']['entity']['id'],
            "wallet_id"=>$business['message']['entity']['wallets'][0]['id'],
            'user_id'=>$user->id
        ]);
      
        if($business['message']['status'] == 'Active'){
            $user->tap_verified = true;
            $user->save();
            Mail::to($user->email)->send(new ApprovedBusiness($user));
        }
      
        return redirect()->route('tap.payments')->with('success', __('New Business has been created successfully.'));
        
    }

}
