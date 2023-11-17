<?php
namespace App\Traits;

trait TenantSharedRoutesTrait
{
    public static function groups(){
        return [
            self::getSharedRoutes(),
            self::getGuestRoutes(),
            self::getPrivateRoutes(),
        ];
    }
    public static function getSharedRoutes(): array
    {
        return [
            'routes'=>[
                ''=>"home",

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
    public static function getPrivateRoutes(): array
    {
         return [
            'routes'=>[
                'restaurants/{branch_id}'=>"restaurants",
                'restaurants/{branch_id}/preview'=>"restaurants.preview",
                'customers/{branch_id}'=>"customers",
                'customers/{branch_id}/preview'=>"customers.preview",
                'switcher'=>'restaurant.switcher',
            ],
            'middleware'=>[
                'auth',
                'verified',
            ]
        ];

    }

}
