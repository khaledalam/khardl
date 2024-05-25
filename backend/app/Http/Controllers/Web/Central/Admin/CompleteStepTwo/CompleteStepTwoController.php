<?php

namespace App\Http\Controllers\Web\Central\Admin\CompleteStepTwo;

use App\Http\Controllers\API\Central\Auth\RegisterController;
use App\Http\Requests\Central\CompleteStepTwo\CompleteStepTwoFormRequest;
use App\Http\Requests\Central\RestaurantOwner\UpdateRestaurantOwnerFromRequest;
use App\Models\Tenant\RestaurantUser;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class CompleteStepTwoController extends Controller
{

    public function completeStepTwo(Request $request, User $user)
    {
        if($user->restaurant){
            return redirect()->route('admin.restaurant-owner-management')->with('error', __('User is already have a restaurant'));
        }
        return view('admin.completeStepTwo.index', compact('user'));
    }
    public function storeStepTwo(UpdateRestaurantOwnerFromRequest $updateRestaurantOwnerFromRequest, CompleteStepTwoFormRequest $completeStepTwoFormRequest, User $user)
    {
        try {
            $this->updateROInformation($user, request());
            $stepTwoMethod = new RegisterController();
            $restaurant = $stepTwoMethod->createNewRestaurant($user->refresh(), request());
            if (request()->has('active') && request()->active == 'true') {
                $restaurant->activeRestaurant();
            }
            return redirect()->route('admin.restaurant-owner-management')->with('success', __('Restaurant has been created successfully'));
        } catch (\Exception $e) {
            \Sentry\captureException($e);
            return redirect()->route('admin.restaurant-owner-management')->with('error', __('An error occurred'));
        }
    }
    public function updateROInformation($user, $request)
    {
        if ($request->has('password') && $request->password !=null) {
            $user->update(['password' => Hash::make($request['password'])]);
        }
        $request['status'] = RestaurantUser::ACTIVE;
        $user->update($request->only([
            'first_name',
            'last_name',
            'position',
            'email',
            'phone',
            'restaurant_name',
            'restaurant_name_ar',
            'status'
        ]));
    }
}
