<?php

namespace App\Nova\Menu;
use App\Nova\Tenant\User;
use Laravel\Nova\Nova;
use App\Nova\Dashboards\Main;
use App\Nova\Tenant\Branch;
use App\Nova\Tenant\Category;
use Laravel\Nova\Menu\MenuItem;
use Laravel\Nova\Menu\MenuSection;
use Illuminate\Http\Request;
class TenantMenu
{
    public static function Menu()
    {
        return [
           
            Nova::mainMenu(function (Request $request) {
                return [
                    MenuSection::resource(Branch::class)
                    ->icon("library"),
                    MenuSection::make(__('Customers'), [
                        MenuItem::resource(User::class)
                    ])
                    ->icon('user')
                    ->collapsable(),
                   
                    MenuSection::resource(Category::class)

    
                    
                ];
            })
        ];
    }
}
