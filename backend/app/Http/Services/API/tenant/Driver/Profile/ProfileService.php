<?php

namespace App\Http\Services\API\tenant\Driver\Profile;

use App\Http\Resources\API\Tenant\DriverResource;
use App\Http\Services\tenant\Driver\DriverService;
use App\Traits\APIResponseTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileService extends DriverService
{
    use APIResponseTrait;
    public function changePassword(Request $request)
    {
        Auth()->user()->update(['password' => Hash::make($request->password)]);
        return $this->sendResponse('', __('Password has been changed successfully'));
    }
    public function getProfile()
    {
        $driver = getAuth();
        return $this->sendResponse(new DriverResource($driver),'');
    }
    public function updateImage($request)
    {
        $driver = getAuth();
        $driver->image = $this->handleImage($request, $driver->image);
        $driver->save();
        return $this->sendResponse(new DriverResource($driver), __('Profile image updated successfully'));
    }
}
