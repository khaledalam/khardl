<?php

namespace App\Http\Controllers\Central;

use App\Http\Controllers\API\BaseController;

class AuthenticationController extends BaseController
{
    public function auth(){
        $user = auth()->user();
        if($user){
            return $this->sendResponse($user,"Authenticated.");
        }else {
            return $this->sendError($user,"UnAuthenticated.",401);
        }
    }
}
