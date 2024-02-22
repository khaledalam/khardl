<?php

namespace App\Http\Controllers\Web\Central;

use Exception;
use App\Models\Tenant;
use App\Models\Tenant\Order;
use Illuminate\Http\Request;
use App\Models\CentralSetting;
use App\Http\Controllers\Controller;

class DeliveryWebhookController extends Controller
{
    public function redirect(Request $request){
        try{
           
            \Sentry\captureMessage('new Central delivery webhook');
            $url = CentralSetting::first()->webhook_url;
       
            if($url){     // testing url webhook
                $client = new \GuzzleHttp\Client();
                $data = [ 
                    'query' =>$request->all(),
                    'headers'=>[
                        'Delivery-Company'=>request()->header('Delivery-Company') ?? '',
                        'Origin-Id'=>request()->header('Origin-Id') ?? '',
                    ]
                ];
                $request = $client->request('post',$url,$data);
                return response()->json(['message'=>"received"],200);
            } else {      // production url webhook
                $client = new \GuzzleHttp\Client();
                $data = [ 
                    'query' =>$request->all() + 
                    ['delivery_company'=>request()->header('Delivery-Company') ?? '']
                ];
            }
            if(request()->header('Delivery-Company') == 'yeswa') {
                $tenant_id = request()->header('Origin-Id') ?? false;
                if(!$tenant_id){
                    \Sentry\captureMessage('no origin id sent with yeswa');
                    return response()->json(['message'=>"not received"],404);
                }
                $restaurant  = Tenant::find($tenant_id);
                if(!$restaurant){
                    \Sentry\captureMessage("Yeswa : no restaurant found with tenant id $tenant_id");
                    return response()->json(['message'=>"not received"],404);
                }
                
                $url = tenant_route($restaurant->primary_domain->domain.'.'.config("tenancy.central_domains")[0],'webhook-client-delivery-companies').'?delivery_company=yeswa';
                $request = $client->request('post',$url,$data);
                return response()->json(['message'=>"received"],200);

            }
   
         
        }    
        catch(Exception $e){

        }
        return response()->json(['message'=>"not received"],404);

    }
}
