<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Utils\ResponseHelper;
use Illuminate\Http\Request;

class BaseController extends Controller
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
