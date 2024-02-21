<?php

namespace App\Http\Controllers\Web\Central;

use Exception;
use Illuminate\Http\Request;
use App\Models\CentralSetting;
use App\Http\Controllers\Controller;
use App\Models\Tenant;

class DeliveryWebhookController extends Controller
{
    public function redirect(Request $request){
        try{
            $client = new \GuzzleHttp\Client();
            $data = [ 
                'query' =>$request->all() + 
                ['delivery_company'=>request()->header('Delivery-Company') ?? '']
            ];
            if(request()->header('Delivery-Company') == 'yeswa') {
                $tenant_id = request()->header('Origin-Id') ?? false;
                if(!$tenant_id){
                    \Sentry\captureMessage('no origin id sent with yeswa');
                    return response()->json(['message'=>"not received"],404);
                }
                $restaurant  = Tenant::find($tenant_id);
                if(!$restaurant){
                    \Sentry\captureMessage("no restaurant fond with tenant id $tenant_id");
                    return response()->json(['message'=>"not received"],404);
                }
                $url = $restaurant->run(fn()=> route('webhook-client-delivery-companies'));
                $request = $client->request('post',$url,$data);
                return response()->json(['message'=>"received"],200);

            }
         
        }    
        catch(Exception $e){

        }
        return response()->json(['message'=>"not received"],404);

    }
}
