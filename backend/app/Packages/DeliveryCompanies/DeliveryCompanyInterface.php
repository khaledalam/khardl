<?php

namespace App\Packages\DeliveryCompanies;

use App\Models\Tenant\Order;
use GuzzleHttp\Promise\Promise;
use App\Models\Tenant\RestaurantUser;

interface DeliveryCompanyInterface
{
    public function assignToDriver(Order $order,RestaurantUser $customer): bool;
    public function send(string $url,$token,array $data,string $method = 'post') : Promise;
    public function verifyApiKey(string $api_key) : bool;
    public function cancelOrder(string $id) : bool;


}
