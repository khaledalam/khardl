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

//       $customerByLocationByLocation['test']['test']['test'] = 5;
//       $customerByLocationByLocation['test']['test']['t'] = 34;
//       $customerByLocationByLocation['test']['3f']['t'] = 7;
//       $customerByLocationByLocation['another']['3f']['t'] = 2;
//       $customerByLocationByLocation['another']['tew']['t'] = 6;

       asort($customerByLocationByLocation);

       return $customerByLocationByLocation;

   }

   public static function getVisualization($array, $location_chart_by) {

       $byCounty = $byCity = $byRegion = [];
       foreach ($array as $country => $countryList) {
           foreach ($countryList as $city => $cityList) {
               foreach ($cityList as $region => $ordersCount) {
//                   $filtered_data[] = [$country, $city, $region, $ordersCount, $rank++ ];

                   if (!in_array($country, $byCounty)) {
                       $byCounty[$country] = 0;
                   }
                   if (!in_array($city, $byCity)) {
                       $byCity[$city] = 0;
                   }
                   if (!in_array($region, $byRegion)) {
                       $byRegion[$region] = 0;
                   }

                   $byCounty[$country] += $ordersCount;
                   $byCity[$city] += $ordersCount;
                   $byRegion[$region] += $ordersCount;
               }
           }
       }


       if (!in_array($location_chart_by, ['country', 'city', 'region'])) {
           $location_chart_by = 'city';
       }

       if ($location_chart_by == 'country') {
           $chart_data =  [
               'labels' => array_keys($byCounty),
               'data' => array_values($byCounty),
           ];

       } else if ($location_chart_by == 'city') {
           $chart_data =  [
               'labels' => array_keys($byCity),
               'data' => array_values($byCity),
           ];
       } else if ($location_chart_by == 'region') {
           $chart_data =  [
               'labels' => array_keys($byRegion),
               'data' => array_values($byRegion),
           ];
       }

       return $chart_data;
   }
}
