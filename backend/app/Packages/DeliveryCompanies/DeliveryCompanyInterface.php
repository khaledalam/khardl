<?php

namespace App\Packages\DeliveryCompanies;

use Exception;
use App\Models\Tenant\Order;
use GuzzleHttp\Promise\Promise;
use App\Models\Tenant\RestaurantUser;

interface DeliveryCompanyInterface
{
    public function assignToDriver(Order $order,RestaurantUser $customer,$duplicated = false): bool | Exception;
    public function verifyApiKey(string $api_key) : bool;
    public function cancelOrder(string $id) : bool;
    public function processWebhook(array $payload);
    public function sendNotification(Order $order);


}
