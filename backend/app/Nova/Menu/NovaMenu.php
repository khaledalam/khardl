<?PHP

namespace App\Nova\Menu;

use Laravel\Nova\Tool;
use Illuminate\Http\Request;
use App\Nova\Menu\TenantMenu;
use App\Nova\Menu\CentralMenu;


class NovaMenu extends Tool
{
   
    public function menu(Request $request): mixed
    {
        if (tenancy()->initialized) {
            return TenantMenu::Menu();
        }else{
            return CentralMenu::Menu();
        }
    }
}
