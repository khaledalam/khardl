<?php

namespace App\Utils;
use App\Models\Tenant\Order;
use Illuminate\Http\Request;

class OrdersLocationsHelper
{
   public static function getCustomerOrdersByLocation(Request $request)
   {
       $orders = Order::where('manual_order_first_name', '=', null)
           ->where('status', '=', Order::COMPLETED)
           ->whenSearch($request['search_location'] ?? null)
           ->get()->all();

       $customerByLocationByLocation = [];


       foreach ($orders as $order) {
           $country = $order->country ?? 'N/A';
           $city = $order->city ?? 'N/A';
           $region = $order->region ?? 'N/A';

           if ($country == 'N/A' || $city == 'N/A' || $region == 'N/A') {
               continue;
           }

           if (!in_array($country, $customerByLocationByLocation)) {
               $customerByLocationByLocation[$country] = [];
           }

           if (!in_array($city, $customerByLocationByLocation[$country])) {
               $customerByLocationByLocation[$country][$city] = [];
           }

           if (!in_array($region, $customerByLocationByLocation[$country][$city])) {
               $customerByLocationByLocation[$country][$city][$region] = 0;
           }

           $customerByLocationByLocation[$country][$city][$region]++;
       }

       $customerByLocationByLocation['test']['test']['test'] = 5;
       $customerByLocationByLocation['test']['test']['t'] = 7;
       $customerByLocationByLocation['test']['3f']['t'] = 7;
       $customerByLocationByLocation['another']['3f']['t'] = 7;

       asort($customerByLocationByLocation);

       return $customerByLocationByLocation;

   }
}
