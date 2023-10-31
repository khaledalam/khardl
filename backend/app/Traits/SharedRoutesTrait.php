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
                'advantages'=>'advantages',
                'clients'=>'clients',
                'services'=>'services',
                'privacy'=>'privacy',
                'policies'=>'policies',
                'prices'=>'prices',
                'fqa'=>'fqa',
                'switcher'=>'switcher',
                'restaurants/{branch_id}'=>"restaurants",
                'restaurants/{branch_id}/preview'=>"restaurants.preview",
                'customers/{branch_id}'=>"customers",
                'customers/{branch_id}/preview'=>"customers.preview"
            ],
            'middleware'=>[
               
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
