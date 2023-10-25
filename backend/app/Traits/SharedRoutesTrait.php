<?php
namespace App\Traits;

trait SharedRoutesTrait
{
    public static function getSharedRoutes(): array
    {
        return [
            /*'reset-password',
           'verification-email',
           'create-new-password',
           'verification-password',
           'complete-register',*/
            '',
            'register',
            'login',
            'Advantages',
            'Clients',
            'Services',
            'Prices',
            'FQA',
            'resetpassword',
            'verificationemail',
            'createnewpassword',
            'verificationpassword',
            'completeregister',
        ];
    }
}
