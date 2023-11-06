<?php

namespace App\Nova\Menu;
use App\Nova\User;
use Laravel\Nova\Nova;
use App\Nova\Dashboards\Main;
use App\Nova\Domain;
use App\Nova\Tenant;
use Laravel\Nova\Menu\MenuItem;
use Laravel\Nova\Menu\MenuSection;
use Illuminate\Http\Request;

class CentralMenu
{
    public static function Menu()
    {
        return [
            Nova::mainMenu(function (Request $request) {
                return [
                    MenuSection::dashboard(Main::class)->icon('chart-bar'),

                    MenuSection::make(__('Restaurants'), [
                        MenuItem::resource(Tenant::class),
                        MenuItem::resource(Domain::class),
                    ])->icon('user')->collapsable(),

                    MenuSection::make(__('Restaurant Owners'), [
                        MenuItem::resource(User::class),
                    ])->icon('user')->collapsable(),
    
                    
                ];
            })
        ];
    }
}
