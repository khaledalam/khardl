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
        $session = tenant()->id.'_card_customer_'.Auth::id();
        if(session()->get($session)){
            return session()->get($session);
        }else {
            $cards = TapCustomer::retrieve($user->tap_customer_id);
            if($cards['http_code'] == ResponseHelper::HTTP_OK){
                if(isset($cards['message']['cards'])){
                    $response = $this->sendResponse($cards['message']['cards'],true);;
                    session(["$session"=>$response]);
                    return $response;
                }
            }
            $response = $this->sendResponse(__('No card found'), true);
            session(["$session"=>$response]);
            return $response;
        }

    }



}
