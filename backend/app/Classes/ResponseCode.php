<?php
namespace App\Classes;


class ResponseCode extends ResponseBaseClass  {

    public function check($user){
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
    
    public  function Authenticated($code = Self::HTTP_AUTHENTICATED){
        return $this->Response("User is Authenticated",$code);
    }
    public  function UnAuthenticated($code = Self::HTTP_AUTHENTICATED){
        return $this->Response("User is not UnAuthenticated",$code);
    }
    public  function Verified($code = Self::HTTP_NOT_VERIFIED){
        return $this->Response("User Verified before",$code);
    }
    public  function NotVerified($code = Self::HTTP_NOT_ACCEPTED){
        return $this->Response("User is not Verified",$code);
    }
    public  function Accepted($code = Self::HTTP_NOT_VERIFIED){
        return $this->Response("User has complete the registration",$code);
    }
    public  function NotAccepted($code = Self::HTTP_NOT_ACCEPTED){
        return $this->Response("User has not complete the registration",$code);
    }


}
