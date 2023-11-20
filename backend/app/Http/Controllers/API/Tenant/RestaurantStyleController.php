<?php

namespace App\Http\Controllers\API\Tenant;

use App\Models\Tenant\RestaurantStyle;
use Illuminate\Http\Request;
use App\Traits\APIResponseTrait;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;


class RestaurantStyleController extends Controller
{
   use APIResponseTrait;

   public function save(Request $request){
        $request->validate([
            '' => 'required|string',
        ]);
        $user = Auth::user();

        //@TODO: validate and save logic here

        return $this->sendResponse(null, __('Restaurant style saved successfully.'));

   }

    public function fetch($item,Request $request)
    {
        $user = Auth::user();

        $style = RestaurantStyle::
            where('user_id',$user->id)
            ->where('branch_id',$user->branch->id)
                ->findOrFail();

        return $this->sendResponse([
            'result' => $style
        ], __('Restaurant style fetched successfully.'));

    }

}
