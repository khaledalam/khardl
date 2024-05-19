<?php

namespace App\Http\Services\tenant\AdsPackage;

use App\Http\Middleware\Restaurant;
use App\Models\AdvertisementPackage;
use App\Models\Tenant\RestaurantUser;
use App\Models\User;
use App\Traits\APIResponseTrait;


class AdsPackageService
{
    use APIResponseTrait;
    public function index($request)
    {
        $ROUser = RestaurantUser::find(1);
        $AdsPackages = tenancy()->central(function () {
            return AdvertisementPackage::active()
                ->get();
        });
        $requestedPackages = tenancy()->central(function ()use($ROUser) {
            $user = User::where('email', $ROUser->email)->first();
            return $user->requested_advertisements()->with('advertisement_package')->get();
        });
        return view('restaurant.advertisement_services.index', compact('AdsPackages','requestedPackages'));
    }
    public function store($request, $advertisement)
    {
        try {
            $advertisement = tenancy()->central(function () use ($advertisement) {
                return AdvertisementPackage::findOrFail($advertisement);
            });
            $ROUser = RestaurantUser::find(1);
            tenancy()->central(function () use ($advertisement, $request, $ROUser) {
                $user = User::where('email', $ROUser->email)->first();
                $advertisement->requests()->create([
                    'price' => $request->price,
                    'user_id' => $user->id
                ]);
            });
            return redirect()->route('restaurant.advertisements.index')->with(['success' => __('Your request has been sent to the admin, wait for the response')]);
        } catch (\Exception $exception) {
            dd($exception);
        }
    }
}
