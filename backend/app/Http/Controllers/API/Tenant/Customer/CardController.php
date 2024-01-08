<?php

namespace App\Http\Controllers\API\Tenant\Customer;

use App\Utils\ResponseHelper;
use App\Traits\APIResponseTrait;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Packages\TapPayment\Customer\Customer as TapCustomer;

class CardController
{
    use APIResponseTrait;
    
    public function show()
    {
        $user = Auth::user();
        $cards = TapCustomer::retrieve($user->tap_customer_id);
        if($cards['http_code'] == ResponseHelper::HTTP_OK){
            if(isset($cards['message']['cards'])){
                return $this->sendResponse($cards['message']['cards'],true);
                // TODO @todo update session to be one day
                // Session::put('customer_card_'.$user->id,$cards['message']['cards'], $dailyExpiration);

            }
        }
        return $this->sendError(__('No card found'));
    }



}
