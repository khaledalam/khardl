<?php

namespace App\Http\Services\tenant\DeliveryCompanies;

use Illuminate\Http\Request;

use App\Traits\APIResponseTrait;
use Illuminate\Support\Facades\Auth;
use App\Models\Tenant\DeliveryCompany;
use App\Packages\DeliveryCompanies\Cervo\Cervo;
use App\Packages\DeliveryCompanies\Yeswa\Yeswa;
use App\Packages\DeliveryCompanies\StreetLine\StreetLine;

class DeliveryService
{
    use APIResponseTrait;
    public function toggleActivation($module, $request)
    {

        $request->validate([
            'api_key' => "required"
        ]);
        $company = DeliveryCompany::where("module", $module)->first();
        if ($company->status == false) {
            if (!$company->module->verifyApiKey($request->api_key)) {
                return redirect()->back()->with([
                    'error' => __("Api Key not correct, please contact :module support team to ensure about it", ['module' => $module]),
                ]);
            }
        }

        $company->update([
            'status' => !$company->status,
            'api_key' => $request->api_key
        ]);
        $message = ($company->status) ? __(':module has been successfully activated') : __(':module has been successfully deactivated');
        return redirect()->back()->with([
            'success' => __($message, ['module' => __($module)]),
        ]);

    }
    public function getDeliveryCompanies($request)
    {
        $user = Auth::user();
        $modules = [
            class_basename(Yeswa::class),
            class_basename(Cervo::class),
            class_basename(StreetLine::class),
        ];

        $deliveryCompanies = DeliveryCompany::whereIn('module', $modules)
        ->whenModule($request['area'] ?? null);
        $yeswa = clone $deliveryCompanies;
        $yeswa = $yeswa->where('module', 'Yeswa')->first();
        $cervo = clone $deliveryCompanies;
        $cervo = $cervo->where('module', 'Cervo')->first();
        $streetline = clone $deliveryCompanies;
        $streetline = $streetline->where('module', 'StreetLine')->first();
        $allCities = $deliveryCompanies->pluck('coverage_area')->flatten()->unique();
        return view(
            'restaurant.delivery_companies.companies',
            compact('user', 'streetline', 'yeswa', 'cervo', 'allCities')
        );
    }
}
