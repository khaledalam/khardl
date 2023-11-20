<?php

namespace App\Http\Controllers\API\Tenant;

use App\Models\Tenant\CustomerStyle;
use Illuminate\Http\Request;
use App\Traits\APIResponseTrait;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;


class CustomerStyleController extends Controller
{
   use APIResponseTrait;

    public function save(Request $request){
        $request->validate([
            '' => 'required|string',
        ]);
        $user = Auth::user();

        //@TODO: validate and save logic here

        return $this->sendResponse(null, __('Customer style saved successfully.'));

    }

    public function fetch(Request $request)
    {
        $user = Auth::user();

        $style = CustomerStyle::
            where('user_id',$user->id)
                ->findOrFail();

        return $this->sendResponse([
            'result' => $style
        ], __('Customer style fetched successfully.'));

    }

}
