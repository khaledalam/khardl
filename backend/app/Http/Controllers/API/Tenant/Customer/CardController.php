<?php

namespace App\Http\Controllers\API\Tenant\Customer;

use App\Packages\TapPayment\Card\Card as TapCard;
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
            $cards = TapCustomer::retrieve($user->tap_customer_id ?? '');
            if($cards['http_code'] == ResponseHelper::HTTP_OK){
                if(isset($cards['message']['cards'])){
                    $response = $this->sendResponse($cards['message']['cards'],true);
                    session(["$session"=>$response]);
                    return $response;
                }
            }
            $response =    $this->sendError(__('No card found'));
            session(["$session"=>$response]);
            return $response;
        }

    }
    public function delete($card_id){
        $user = Auth::user();
        $card = TapCard::delete($user->getTapCustomerId(),$card_id);
        if($card['http_code'] == ResponseHelper::HTTP_OK){
            if(isset($card['message']['deleted']) && $card['message']['deleted']){
                $session = tenant()->id.'_card_customer_'.Auth::id();
                session()->flush($session);
                return $this->sendResponse(__('Card has been deleted successfully'), true);
            }
        }
        return $this->sendError(__('No card found'));

    }



}
