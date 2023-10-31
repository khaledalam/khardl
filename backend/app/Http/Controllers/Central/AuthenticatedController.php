<?php

namespace App\Http\Controllers\Central;

use App\Classes\ResponseCode;
use App\Http\Controllers\Controller;

class AuthenticatedController extends Controller
{
    protected ResponseCode $response;
    public function __construct(ResponseCode $response)
    {
        $this->response= $response;
    }
    public function auth(){
        return $this->response->check(auth()->user());
    }
}
