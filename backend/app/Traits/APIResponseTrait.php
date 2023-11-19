<?php

namespace App\Traits;

use App\Http\Controllers\Controller;
use App\Utils\ResponseHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

trait APIResponseTrait 
{
    public function sendResponse($result, $message)
    {
        $response = [
            'success' => true,
            'data'    => $result,
            'message' => $message,
        ];
        return response()->json($response);
    }

    public function sendError($error, $errorMessages = [], $code = ResponseHelper::HTTP_FORBIDDEN)
    {
        $response = [
            'success' => false,
            'message' => $error,
        ];
        if(!empty($errorMessages)){
            $response['data'] = $errorMessages;
        }
        return response()->json($response, $code);
    }
}
