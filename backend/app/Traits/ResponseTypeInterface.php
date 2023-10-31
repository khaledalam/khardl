<?php

namespace App\Traits;

interface ResponseTypeInterface
{
    public  function Authenticated();
    public  function UnAuthenticated();
    public  function Verified();
    public  function NotVerified();
    public  function Accepted();
    public  function NotAccepted();
}
