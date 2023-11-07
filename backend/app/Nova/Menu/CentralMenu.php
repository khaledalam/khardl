<?php

namespace App\Nova\Menu;
use Laravel\Nova\Nova;
use App\Nova\Central\User;
use App\Nova\Central\Domain;
use App\Nova\Central\Tenant;
use Illuminate\Http\Request;
use App\Nova\Dashboards\Main;
use Laravel\Nova\Menu\MenuItem;
use Laravel\Nova\Menu\MenuSection;

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
                    ])->icon('library')->collapsable(),

                    MenuSection::make(__('Owners'), [
                        MenuItem::resource(User::class),
                    ])->icon('user-group')->collapsable(),
    
                    
                ];
            })
        ];
    }
}
