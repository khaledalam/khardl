<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Utils\ResponseHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BaseController extends Controller
{
    public function sendResponse($result, $message)
    {
        $response = [
            'success' => true,
            'data'    => $result,
            'message' => $message,
            'is_loggedin' => Auth::check()
        ];
        return response()->json($response);
    }

    public function sendError($error, $errorMessages = [], $code = ResponseHelper::HTTP_FORBIDDEN)
    {
        $response = [
            'success' => false,
            'message' => $error,
            'is_loggedin' => Auth::check()
        ];

        if(!empty($errorMessages)){
            $response['data'] = $errorMessages;
        }

        return response()->json($response, $code);
    }
}
