<?php
namespace  App\Traits;

use App\Traits\StatusCodes;
use Illuminate\Support\Facades\Response;

class ResponseCode extends ResponseBaseClass  {

    public function __invoke(){
        $user = auth()->user();
        if($user){
            if($user->hasVerifiedEmail()){
                if(!$user->traderRegistrationRequirement) return $this->NotAccepted();
            }else {
                return $this->NotVerified();
            }
            return $this->Authenticated();
        }else{
            return $this->UnAuthenticated();
        }
    }
    
    public  function Authenticated(){
        return $this->Response("Authenticated",Self::HTTP_AUTHENTICATED);
    }
    public  function UnAuthenticated(){
        return $this->Response("UnAuthenticated",Self::HTTP_AUTHENTICATED);
    }
    public  function NotVerified(){
        return $this->Response("NotVerified",Self::HTTP_NOT_VERIFIED);
    }
    public  function NotAccepted(){
        return $this->Response("NotAccepted",Self::HTTP_NOT_ACCEPTED);
    }


}
