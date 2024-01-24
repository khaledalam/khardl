<?php

namespace App\Packages\DeliveryCompanies;

use App\Models\Tenant\Order;
use GuzzleHttp\Promise\Promise;
use App\Models\Tenant\RestaurantUser;

interface DeliveryCompanyInterface
{
    public function assignToDriver(Order $order,RestaurantUser $customer): bool;
    public function verifyApiKey(string $api_key) : bool;
    public function cancelOrder(string $id) : bool;
    public function processWebhook(array $payload);


}
