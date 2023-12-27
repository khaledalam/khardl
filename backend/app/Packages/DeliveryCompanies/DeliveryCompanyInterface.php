<?php

namespace App\Packages\DeliveryCompanies;

interface DeliveryCompanyInterface
{
    public function assignToDriver($order);
    public function send(string $url,string $method,bool $token,array $data) : array;


}
