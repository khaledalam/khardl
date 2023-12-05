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
            'primary_color' => 'required|string',
            'buttons_style' => 'required|string',
            'images_style' => 'required|string',
            'font_family' => 'required|string',
            'font_type' => 'required|string',
            'font_size' => 'required|string',
        ]);
     
        CustomerStyle::updateOrCreate([
            'id'=>1
        ],[
            'id'=>1,
            'primary_color' => $request->primary_color,
            'buttons_style' => $request->buttons_style,
            'images_style' =>$request->images_style,
            'font_family' => $request->font_family,
            'font_type' =>$request->font_type,
            'font_size' => $request->font_size,
            'user_id'=> Auth::user()->id
        ]);
 
         return $this->sendResponse(null, __('Customer style saved successfully.'));
 
    }

    public function fetch(Request $request)
    {
        return $this->sendResponse(CustomerStyle::first() ?? [], __('Customer style fetched successfully.'));
    }

}
