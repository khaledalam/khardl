<?PHP

namespace App\Nova\Menu;

use App\Nova\User;
use Laravel\Nova\Nova;
use PharIo\Manifest\License;
use App\Nova\Dashboards\Main;
use App\Nova\FQA;
use App\Nova\Point;
use Laravel\Nova\Menu\MenuItem;
use Laravel\Nova\Menu\MenuSection;
use Illuminate\Http\Request;
class NovaMenu
{
    public static function showMenu()
    {
        return [
            Nova::mainMenu(function (Request $request) {
                return [
                    MenuSection::dashboard(Main::class)->icon('chart-bar'),
    
                    MenuSection::make(__('Customers'), [
                        MenuItem::resource(User::class),
                    ])->icon('user')->collapsable(),
    
                    MenuSection::make(__('Content'), [
                        MenuItem::resource(FQA::class),
                        MenuItem::resource(Point::class),
                    ])
                    ->icon('document-text')
                    ->collapsable(),
                ];
            })
        ];
    }
}
