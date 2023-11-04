<?php

namespace App\Utils;

use Illuminate\Http\JsonResponse;

class ResponseHelper {
    const HTTP_OK                   = 200;
    const HTTP_CREATED              = 201;
    const HTTP_UNAUTHORIZED         = 401;
    const HTTP_FORBIDDEN            = 403;
    const HTTP_NOT_FOUND            = 404;
    const HTTP_TOO_MANY_REQUESTS    = 429;

    const HTTP_AUTHENTICATED        = 200;
    const HTTP_NOT_AUTHENTICATED    = 401;
    const HTTP_VERIFIED             = 203;
    const HTTP_NOT_VERIFIED         = 204;
    const HTTP_ACCEPTED             = 205;
    // not approve restaurant owner trade documents
    const HTTP_NOT_ACCEPTED         = 206;
    const HTTP_BLOCKED              = 207;

    public static function response(array $data, int $code): JsonResponse
    {
        return response()->json($data, $code);
    }

}
