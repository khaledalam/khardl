<?php
namespace App\Traits;

trait TenantSharedRoutesTrait
{
    public static function groups(){
        return [
            self::getSharedRoutes(),
            self::getGuestRoutes(),
//            self::getPrivateRoutes(),
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
                'login'=>'login',
                'login-admins'=>'login-admins'
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
                '/site-editor/restaurants'=>"restaurants.site_editor",
                '/site-editor/restaurants/preview'=>"restaurants.site_editor.preview",
                '/site-editor/customers'=>"customers.site_editor",
                '/site-editor/customers/preview'=>"customers.site_editor.preview",
                '/site-editor'=>'site_editor',
            ],
            'middleware'=>[
                'auth', 'restaurant'
            ]
        ];

    }

}
