<?php
namespace App\Traits;

trait SharedRoutesTrait
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
                'switcher'=>'switcher',
                // TODO @todo: move restaurants routes under auth guard after its flow complete
                'restaurants/{branch_id}'=>"restaurants",
                'restaurants/{branch_id}/preview'=>"restaurants.preview",
                'customers/{branch_id}'=>"customers",
                'customers/{branch_id}/preview'=>"customers.preview"
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
