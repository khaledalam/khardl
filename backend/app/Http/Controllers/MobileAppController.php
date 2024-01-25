<?php

namespace App\Http\Controllers;

use App\Models\Tenant;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\API\BaseController;
use Illuminate\Http\Request;

class MobileAppController extends BaseController
{
    public function restaurants(Request $request){
        $restaurants = Tenant::has('primary_domain')->whereHas('central_tenant_setting', function ($query) {
            return $query->where('is_live', 1);
        });
        
        if($request->has('name')){
            $restaurants->where('restaurant_name', 'LIKE', "%{$request->name}%"); 
        }
        return $this->sendResponse($restaurants->get()
        ->map(function ($restaurant) {
            return [
                'restaurant_name' => $restaurant->restaurant_name,
                'url' => $restaurant->getUrlAttribute(), 
            ];
        }),'');
    }
}
