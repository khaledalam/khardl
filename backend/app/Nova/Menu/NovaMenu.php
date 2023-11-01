<?PHP

namespace App\Nova\Menu;

use App\Nova\User;
use Laravel\Nova\Nova;
use PharIo\Manifest\License;
use App\Nova\Dashboards\Main;
use Laravel\Nova\Menu\MenuItem;
use Laravel\Nova\Menu\MenuSection;
use Illuminate\Http\Request;
class NovaMenu
{
    public static function showMenu()
    {
        if (tenancy()->initialized) {
            return TenantMenu::Menu();
        }else{
            return CentralMenu::Menu();
        }

    }
}
