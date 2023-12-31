<?php

namespace App\Packages\DeliveryCompanies;

use App\Models\Tenant\Order;
use GuzzleHttp\Promise\Promise;
use App\Models\Tenant\RestaurantUser;

interface DeliveryCompanyInterface
{
    public function assignToDriver(Order $order,RestaurantUser $customer);
    public function send(string $url,$token,array $data,string $method = 'post') : Promise;


}
