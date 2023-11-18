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
                '/site-editor/restaurants/{branch_id}'=>"restaurants",
                '/site-editor/restaurants/{branch_id}/preview'=>"restaurants.preview",
                '/site-editor/customers/{branch_id}'=>"customers",
                '/site-editor/customers/{branch_id}/preview'=>"customers.preview",
                '/site-editor'=>'restaurant.site_editor',
            ],
            'middleware'=>[
                'auth',
                'verifiedPhone',
            ]
        ];

    }

}
