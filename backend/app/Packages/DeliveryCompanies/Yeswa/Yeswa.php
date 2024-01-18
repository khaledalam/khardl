<?php

namespace App\Packages\DeliveryCompanies\Yeswa;

use App\Models\Tenant\Order;
use App\Models\Tenant\Branch;
use App\Models\Tenant\PaymentMethod;
use App\Models\Tenant\RestaurantUser;
use App\Packages\DeliveryCompanies\AbstractDeliveryCompany;
use App\Packages\DeliveryCompanies\Cervo\Cervo;
use App\Packages\DeliveryCompanies\StreetLine\StreetLine;
use App\Utils\ResponseHelper;

class Yeswa  extends AbstractDeliveryCompany
{
    const CORRESPOND_METHODS = [
        PaymentMethod::CASH_ON_DELIVERY=> 'COD',
        PaymentMethod::CREDIT_CARD=> 'PP',
    ];

    public function assignToDriver(Order $order,RestaurantUser $customer):bool{
        $branch = $order->branch;
        if(env('APP_ENV') == 'local'){
            $data = [
                "api_key"=> env('YESWA_SECRET_API_KEY',''),
                "pickup_name"=> 'Test '.$branch->name,
                "dropoff_name"=> 'Test '.$customer->fullName,
                "pickup_latitude"=> 27.05,
                "pickup_longitude"=>  30.14,
                "dropoff_latitude"=>  27.05,
                "dropoff_longitude"=>  30.14,


            ];
        }else {
            $data = [
                "pickup_name"=>$branch->name,
                "pickup_latitude"=> $branch->lat,
                "pickup_longitude"=>  $branch->lng,
                "dropoff_name"=> $customer->fullName,
                "dropoff_latitude"=> $customer->lat,
                "dropoff_longitude"=> $customer->lng,

            ];
        }
        $data += [
            "api_key"=> $this->delivery_company->api_key,
            "pickup_phone"=> $branch->phone,
            "pickup_address"=> $branch->address,
            "dropoff_phone"=> $customer->phone,
            "dropoff_address"=> $customer->address,
            "order_amount"=> $order->total,
            'client_id'=>$order->id, // instead if customer id
            "payment_method"=>  self::CORRESPOND_METHODS[$order->payment_method->name]  ,
            // nullable
            // "dropoff_time"=> "",
            // "dropoff_notes"=> "",
            // "pickup_time"=> "",
            // "pickup_notes"=> "",
            // "eftops"=> true
            // "client_id"=> "",
        ];

        $response = $this->sendSync(
            url:  $this->delivery_company->api_url.'/create_trip/',
            token: false,
            data: $data
        );
        if($response['http_code'] == ResponseHelper::HTTP_OK){
            $order->update([
                'yeswa_ref'=>$response['message']['data']['trip_ref']
            ]);
            return true;
        }else {
            return false;
        }

    }
    public function processWebhook(array $payload){
        $data = $payload['data']["deliveries"][0];
        if(isset($data['job_status'])  ){
            $order = Order::where('yeswa_ref',$payload['data']['trip_ref'])->firstOrFail();
            if(!$order->deliver_by || $order->deliver_by == class_basename(static::class)){
                
              
                if($data['track']){
                    $order->update([
                        'tracking_url'=> $data['track']
                    ]); 
                }
                if($data['job_status']  == 'ACCEPTED'){
                    $order->update([
                        'status'=>Order::ACCEPTED,
                        'deliver_by'=> class_basename(static::class),
                    ]);

                    $this->cancelOtherOrders("yeswa",$order);
                  
               
                }else if($data['job_status'] == 'SUCCESSFUL'){
                    $order->update([
                        'status'=>Order::COMPLETED
                    ]);
                }else if ($data['job_status'] == 'FAILED' ){
                    $order->update([
                        'status'=>Order::CANCELLED
                    ]);
                }
            }
            
        }
    }
    public function  cancelOrder($id): bool{
        try {
            if(env('APP_ENV') == 'local'){
                $data = [
                    "api_key"=> env('YESWA_SECRET_API_KEY',''),
                    'trip_ref'=>$id,
                ];
            }else {
                $data = [
                    "api_key"=> $this->delivery_company->api_key,
                    'trip_ref'=>$id,
                ];
            }
            $response = $this->sendSync(
                url: $this->delivery_company->api_url . '/cancel_trip/',
                token: false,
                data:  $data
            );
            return $response['http_code'] == ResponseHelper::HTTP_OK ? true : false;
        } catch (\Exception $e) {
            return false;
        }
    }
    public function  verifyApiKey(string $api_key): bool{
        try {
            $response = $this->sendSync(
                url: $this->delivery_company->api_url . '/auth_check/',
                token: false,
                data: [
                    "api_key" => $api_key
                ]
            );
            return $response['http_code'] == ResponseHelper::HTTP_OK ? true : false;
        } catch (\Exception $e) {
            return false;
        }
    }
        

}
