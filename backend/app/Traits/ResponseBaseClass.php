<?php
namespace App\Traits;

use Illuminate\Support\Facades\Response;


abstract class ResponseBaseClass implements ResponseTypeInterface
{
    const HTTP_OK = 200;
    const HTTP_CREATED = 201;
    const HTTP_UNAUTHORIZED = 401;
    const HTTP_FORBIDDEN = 403;
    const HTTP_NOT_FOUND = 404;
    const HTTP_UNPROCESSABLE_ENTITY = 422;
    const HTTP_TOO_MANY_REQUESTS = 429;

    const HTTP_AUTHENTICATED = 200;
    const HTTP_NOT_AUTHENTICATED = 201;
    const HTTP_NOT_ACCEPTED = 203;
    const HTTP_NOT_VERIFIED = 204;
   

    public $status = true;
    public $code;
    public $msg = '';

    public abstract function Authenticated();
    public abstract function UnAuthenticated();
    public abstract function NotVerified();
    public abstract function NotAccepted();

    public function Response($message,$code = self::HTTP_OK){
        $this->code = $code;
        $this->msg = __($message);
        return  Response::json($this);
    }
}