<?php

namespace App\Packages\DeliveryCompanies\StreetLine;

use App\Models\Tenant\Order;
use App\Utils\ResponseHelper;
use App\Models\Tenant\PaymentMethod;
use App\Models\Tenant\RestaurantUser;
use App\Enums\Admin\NotificationTypeEnum;
use App\Notifications\NotificationAction;
use Illuminate\Support\Facades\Notification;
use App\Packages\DeliveryCompanies\AbstractDeliveryCompany;



class StreetLine  extends AbstractDeliveryCompany
{
    const STATUS_ORDER = [
        'Order created' => 1,
        'Pending driver acceptance' => 2,
        'Pending order preparation' => 4,
        'Arrived to pickup' => 16,
        'Order picked up' => 6,
        'Arrived to dropoff' => 8,
        'Order delivered' => 9,
        'Order cancelled' => 10,
        'Driver acceptance timeout' => 13,
        'Driver rejected the order' => 18,
        'Order Unassigned' => 19,
        'Order failed' => 20,
    ];
    public function assignToDriver(Order $order,RestaurantUser $customer,$duplicated = false):bool{
        $branch = $order->branch;
        if(env('APP_ENV') == 'local'){
            $token = env('STREETLINE_SECRET_API_KEY','');
            $data = [
                "pickup_lat"=>'31.952329',
                "pickup_lng"=>'35.932154',
                "lat"=>"31.9625314016",
                "lng"=>"35.8901908945",
                "address"=>"Test Address"

            ];
        }else {
            $token = $this->delivery_company->api_key;
            $data = [
                "pickup_lat"=>$branch->lat,
                "pickup_lng"=>$branch->lng,
                "lat"=>$customer->lat,
                "lng"=>$customer->lng,
                "address"=>$customer->address,


            ];
        }
        $data += [
            "client_order_id"=>$order->id,
            "value"=>$branch->total,
            "payment_type"=> ($order->payment_method->name == PaymentMethod::CASH_ON_DELIVERY)? "CASH": "CREDIT",
            "customer_phone"=>$customer->phone,
            "customer_name"=>$customer->fullName,


        ];

        $response = $this->sendSync(
            url:   $this->delivery_company->api_url."/$token/order/add",
            token: false,
            data: $data
        );
        if($response['http_code'] == ResponseHelper::HTTP_OK){
            $order->update([
                'streetline_ref'=>$response['message']['order_id']
            ]);
            return true;
        }else {
            return false;
        }
    }
    public function cancelOrder($id): bool{
        try {
            if(env('APP_ENV') == 'local'){
                $token =  env('STREETLINE_SECRET_API_KEY','');
            }else {
                $token = $this->delivery_company->api_key;
            }
            $response = $this->sendSync(
                url:   $this->delivery_company->api_url."/$token/order/cancel/$id",
                token: false,
                data: [],
                method: 'get'
            );
            return $response['http_code'] == ResponseHelper::HTTP_OK ? true : false;
        } catch (\Exception $e) {
            return false;
        }
    }
    public function addWebhook($type = 'order_updated'){
        if(env('APP_ENV') == 'local'){
            $token = env('STREETLINE_SECRET_API_KEY','');
        }else {
            $token = $this->delivery_company->api_key;
        }
        return $this->send(
            url:   $this->delivery_company->api_url."/$token/webhooks/add",
            token: false,
            data: [
                'name'=>'Webhook for update order',
                'url'=> route('webhook-client-delivery-companies'),
                'type'=>$type
            ]
        );
    }
    public function processWebhook($payload){
        if(isset($payload["status_id"])  ){
            $order =Order::where('streetline_ref',$payload['order_id'])->firstOrFail();

            if(!$order->deliver_by || $order->deliver_by == class_basename(static::class)){

                if($payload['tracking_url']){
                    $order->update([
                        'tracking_url'=> $payload['tracking_url']
                    ]);
                }
                if($payload['status_id'] == self::STATUS_ORDER['Order delivered']){
                        $order->update([
                            'status'=>Order::COMPLETED
                        ]);
                        $this->sendNotification($order);
                }else if( $payload['status_id'] == self::STATUS_ORDER['Order picked up'] ){
                        $order->update([
                            'status'=>Order::ACCEPTED,
                            'deliver_by'=> class_basename(static::class),
                        ]);
                        $this->cancelOtherOrders("streetline",$order);


                }else if(
                    $payload['status_id'] == self::STATUS_ORDER['Order cancelled'] ||
                    $payload['status_id'] == self::STATUS_ORDER['Order failed'] ){
                    // Todo @todo
                    $order->update([
                        'status'=>Order::CANCELLED
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
            'company' => 'Street line'
        ]);
        //Send notification to all worker
        $workers = RestaurantUser::workers()
        ->where('branch_id',$order->branch_id)
        ->get();
        if($workers->count())Notification::send($workers, new NotificationAction($type, $message, $order));
    }
    public function  verifyApiKey(string $api_key): bool{
        try {
            $response = $this->sendSync(
                url: $this->delivery_company->api_url . "/$api_key/webhooks/list",
                token: false,
                data: [],
                method: 'get'
            );
            return $response['http_code'] == ResponseHelper::HTTP_OK ? true : false;
        } catch (\Exception $e) {
            return false;
        }
    }

}
