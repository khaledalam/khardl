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
                ''=>"homeCentral",
                'advantages'=>'advantages',
                'restaurant-not-found'=>'restaurant_not_found',
                'clients'=>'clients',
                'services'=>'services',
                'privacy'=>'privacy',
                'policies'=>'policies',
                'prices'=>'prices',
                'fqa'=>'fqa',
                
            ],
            'middleware'=>[
                'visitors'
            ]

        ];
    }

    public static function getGuestRoutes(): array
    {
        return [
            'routes'=>[
                'register'=>'register',
                'login'=>'login',
                'reset-password'=> 'reset-password',
                'reset-email'=> 'reset-email',
                'create-new-password'=> 'create-new-password',
            ],
            'middleware'=>[
                'guest',
            ]
        ];
    }
}
