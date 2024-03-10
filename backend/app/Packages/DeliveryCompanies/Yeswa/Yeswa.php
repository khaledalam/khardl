<?php

namespace App\Packages\DeliveryCompanies\Yeswa;

use Exception;
use App\Models\Tenant\Order;
use App\Models\Tenant\Branch;
use App\Utils\ResponseHelper;
use App\Models\Tenant\Setting;
use App\Models\Tenant\PaymentMethod;
use App\Models\Tenant\RestaurantUser;
use App\Enums\Admin\NotificationTypeEnum;
use App\Notifications\NotificationAction;
use Illuminate\Support\Facades\Notification;
use App\Packages\DeliveryCompanies\Cervo\Cervo;
use App\Packages\DeliveryCompanies\StreetLine\StreetLine;
use App\Packages\DeliveryCompanies\AbstractDeliveryCompany;

class Yeswa  extends AbstractDeliveryCompany
{
    const CORRESPOND_METHODS = [
        PaymentMethod::CASH_ON_DELIVERY=> 'COD',
        PaymentMethod::ONLINE=> 'PP',
    ];

    public function assignToDriver(Order $order,RestaurantUser $customer,$duplicated = false):bool{
        $branch = $order->branch;
        $setting = Setting::first();
        if(env('APP_ENV') == 'local'){
            $data = [
                "api_key"=> env('YESWA_SECRET_API_KEY',''),
                "pickup_name"=> 'Test '.$branch->name,
                "dropoff_name"=> 'Test '.$customer->fullName,
                "pickup_latitude"=> 27.05,
                "pickup_longitude"=>  30.14,
                "dropoff_latitude"=>  27.05,
                "dropoff_longitude"=>  30.14,
                'client_id'=>"testing".date("Y/m/d")." ".$order->id,

            ];
        }else {
            $data = [
                "pickup_name"=> $setting->restaurant_name,
                "pickup_latitude"=> $branch->lat,
                "pickup_longitude"=>  $branch->lng,
                "dropoff_name"=> $customer->fullName,
                "dropoff_latitude"=> $order->lat ?? "",
                "dropoff_longitude"=> $order->lng ?? "",
                'client_id'=>$order->id,

            ];
        }
        if($duplicated)
            $data['client_id'] = "Duplicated $order->id";
        $data += [
            "api_key"=> $this->delivery_company->api_key,
            "pickup_phone"=> $branch->phone,
            "pickup_address"=> $branch->address,
            "dropoff_phone"=> $customer->phone,
            "dropoff_address"=> $order->address ?? '',
            "order_amount"=> $order->total,

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
            \Sentry\captureMessage(json_encode($response['message']));
            $order->update([
                'yeswa_ref'=>$response['message']['data']['trip_ref']
            ]);
            return true;
        }else if ($response['http_code'] == ResponseHelper::HTTP_BAD_REQUEST && $response['message'] == 'Order duplicated'){
            throw new Exception('Order duplicated');
        }else {
            \Sentry\captureMessage(json_encode($response['message']));
            return false;
        }

    }
    public function processWebhook(array $payload){
        $data = isset($payload['data']["deliveries"][0])?$payload['data']["deliveries"][0]:null;
        if(isset($data['job_status'])  ){
            $order = Order::where('yeswa_ref',$payload['data']['trip_ref'])->firstOrFail();
            if(!$order->deliver_by || $order->deliver_by == class_basename(static::class)){

                $tracking_url = null;
                if(isset($data['track'])){
                    $tracking_url = $data['track'];
                }
                if(isset($data['tracking_url'])){
                    $tracking_url = $data['tracking_url'];
                }
                if(isset($payload['driver_phone']) && isset($payload['driver_name']) ){
                    $order->update([
                        'driver_name'=> $payload['driver_name'],
                        'driver_phone'=> $payload['driver_phone']
                    ]); 
                }
                if($tracking_url){
                    $order->update([
                        'tracking_url'=>$tracking_url
                    ]);
                }
                if($data['job_status']  == 'ACCEPTED' || $data['job_status']  == 'STARTED' ||$data['job_status']  == 'ARRIVED' || $data['job_status']  == 'ASSIGNED' ){
                    $order->update([
                        'status'=>Order::ACCEPTED,
                        'deliver_by'=> class_basename(static::class),
                    ]);

                    $this->cancelOtherOrders("yeswa",$order);


                }else if($data['job_status'] == 'SUCCESSFUL'){
                    $order->update([
                        'status'=>Order::COMPLETED
                    ]);
                    $this->sendNotification($order);
                }else if ($data['job_status'] == 'FAILED' ){
                    if($order->status != Order::ACCEPTED)
                    $order->update([
                        'status'=>Order::CANCELLED,
                        'reject_or_cancel_reason'=>'Cancelled by Yeswa'
                    ]);
                }
            }

        }
    }
    public function sendNotification($order)
    {
        //Internal notification
        $type = NotificationTypeEnum::OrderDelivered;
        $message = __('Order has been delivered for customer (:name) by delivery company (:company).',
        [
            'name' => $order?->user?->full_name,
            'company' => 'Yeswa'
        ]);
        //Send notification to all worker
        $workers = RestaurantUser::workers()
        ->where('branch_id',$order->branch_id)
        ->get();
        if($workers->count())Notification::send($workers, new NotificationAction($type, $message, $order));
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
            if($response['http_code'] == ResponseHelper::HTTP_OK ){
                return true;
            }else {
                \Sentry\captureMessage("Yeswa cannot cancel order #$id for restaurant #".tenant()->id);
                return false;
            }
        } catch (\Exception $e) {
            \Sentry\captureException($e);
            return false;
        }
    }
    public function  verifyApiKey(string $api_key): bool{

        try {
            $response = $this->sendSync(
                url: $this->delivery_company->api_url . '/auth_check/',
                token: false,
                data: [
                    "api_key" => $api_key,
                    'source'=>tenant()->id
                ]
            );
            return $response['http_code'] == ResponseHelper::HTTP_OK ? true : false;
        } catch (\Exception $e) {
            return false;
        }
    }


}
