<?php

namespace App\Http\Services\tenant\Setting;
use App\Http\Requests\Tenant\Setting\SettingUpdateFormRequest;
use App\Models\Tenant\DeliveryType;
use App\Models\Tenant\Setting;
use App\Traits\APIResponseTrait;
use Illuminate\Support\Facades\Auth;
use App\Models\Tenant\RestaurantUser;

class SettingService
{
    use APIResponseTrait;
    public function get()
    {
        /** @var RestaurantUser $user */
        $user = Auth::user();

        $settings = Setting::all()->firstOrFail();

        return view(
            'restaurant.settings',
            compact('user', 'settings')
        );
    }

    public function update($request)
    {
        $settings = Setting::all()->firstOrFail();

        $settings->update($this->request_data($request));

        $delivery = DeliveryType::where('name', DeliveryType::DELIVERY)->first();

        if ($delivery) {
            $delivery->cost = $settings->delivery_fee;
            $delivery->save();
        }

        return redirect()->back()->with('success', __('Updated successfully'));
    }
    public function request_data($request)
    {
        if($request->delivery_companies_option == null)$request['delivery_companies_option'] = 0;
        if($request->drivers_option == null)$request['drivers_option'] = 0;
        return $request->only(['delivery_fee','limit_delivery_company','delivery_companies_option','drivers_option']);
    }
}
