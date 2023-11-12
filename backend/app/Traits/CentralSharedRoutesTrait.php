<?php
namespace App\Traits;

trait CentralSharedRoutesTrait
{
    public static function groups(){
        return [
            self::getSharedRoutes(),
            self::getGuestRoutes(),
        ];
    }
    public static function getSharedRoutes(): array
    {
        return [
            'routes'=>[
                ''=>"home",
                'advantages'=>'advantages',
                'clients'=>'clients',
                'services'=>'services',
                'privacy'=>'privacy',
                'policies'=>'policies',
                'prices'=>'prices',
                'fqa'=>'fqa',
                'reset-password'=> 'reset-password',
                'create-new-password'=> 'create-new-password',

            ],
            'middleware'=>[
               
            ]

        ];
    }
    
    public static function getGuestRoutes(): array
    {
        return [
            'routes'=>[
                'register'=>'register',
                'login'=>'login'
            ],
            'middleware'=>[
                'guest',
               
            ]
        ];
    }
}
