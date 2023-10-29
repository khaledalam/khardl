<?php
namespace App\Traits;

trait SharedRoutesTrait
{
    public static function groups(){
        return [
            self::getSharedRoutes(),
            self::getAuthRoutes(),
            self::getGuestRoutes(),
        ];
    }
    public static function getSharedRoutes(): array
    {
        return [
            'routes'=>[
                ''=>"home",
                'Advantages'=>'Advantages',
                'Clients'=>'Clients',
                'Services'=>'Services',
                'privacy'=>'privacy',
                'policies'=>'policies',
                'Prices'=>'Prices',
                'FQA'=>'FQA',
            ],
            'middleware'=>[
                'web'
            ]

        ];
    }
    public static function getAuthRoutes(): array
    {
        return [
            'routes'=>[
                'reset-password'=>'reset-password',
                'verification-email'=>'verification-email',
                'create-new-password'=>'create-new-password',
                'verification-password'=>'verification-password',
                'complete-register'=>'complete-register',
            ],
            'middleware'=>[
                'auth',
                'web'
            ]

        ];
    }
    public static function getGuestRoutes(): array
    {
        return [
            'routes'=>[
                'register'=>'register',
                'login'=>'login',
                'switcher' => 'switcher'
            ],
            'middleware'=>[
                'guest',
                'web'
            ]
        ];
    }
}
