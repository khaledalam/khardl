<?php

namespace App\Traits;

interface ResponseTypeInterface
{
    public  function Authenticated();
    public  function UnAuthenticated();
    public  function NotVerified();
    public  function NotAccepted();
}
