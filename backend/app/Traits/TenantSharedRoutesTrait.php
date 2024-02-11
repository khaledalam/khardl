<?php
namespace App\Traits;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
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
    public static function siteEditor(): array
    {
         return [
            'routes'=>[
                '/site-editor/restaurants'=>"restaurants.site_editor",
                '/site-editor/restaurants/preview'=>"restaurants.site_editor.preview",
                '/site-editor'=>'site_editor',
            ],
            'middleware'=>[
                'auth', 'restaurant',
            ]
        ];

    }
    public static function successOrFail(){
        return [
            'routes'=>[
                'success' => 'success',
                'failed' => 'failed',
            ],
            'middleware'=>[

            ]
        ];
    }
    public static function NotLiveOrNotSubscribed(){
        return [
            'routes'=>[
                'restaurant-not-live'=> 'restaurant-not-live',
                'restaurant-not-subscribed'=> 'restaurant-not-subscribed',
            ],
            'middleware'=>[
                'restaurantNotLive'
            ]  
        ];
    }
    public static function run($groups){
        return Route::middleware($groups['middleware'])->group(function () use ($groups) {
            foreach ($groups['routes'] as $route => $name) {
                Route::get($route, static function (Request $request) {
                    return view('tenant');
                })->name($name);
            }
        });
    }
   

}
