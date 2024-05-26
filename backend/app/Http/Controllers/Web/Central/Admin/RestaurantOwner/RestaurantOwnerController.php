<?php

namespace App\Http\Controllers\Web\Central\Admin\RestaurantOwner;

use App\Http\Controllers\API\Central\Auth\RegisterController;
use App\Http\Controllers\Controller;
use App\Http\Requests\Central\RestaurantOwner\UpdateROFormRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RestaurantOwnerController extends Controller
{

    public function show(Request $request, User $user)
    {
        return view('admin.restaurant-owner.show', compact('user'));
    }
    public function update(UpdateROFormRequest $request, User $user)
    {
        try {
            $this->updateUserInfo($user,$request);
            if($user->traderRegistrationRequirement){
                $this->updateTraderRequirements($user,$request);
            }
            return redirect()->route('admin.restaurant-owner-management')->with('success', __('Updated successfully'));
        } catch (\Exception $e) {
            \Sentry\captureException($e);
            return redirect()->route('admin.restaurant-owner-management')->with('error', __('An error occurred'));
        }
    }
    public function updateTraderRequirements($user,$request)
    {
        $registerController = new RegisterController();
        $registerController->createOrUpdateTraderRequirements($user,$request);
    }
    public function updateUserInfo($user,$request)
    {
        if ($request->has('password') && $request->password !=null) {
            $user->update(['password' => Hash::make($request['password'])]);
        }
        $user->update($request->only([
            /* 'first_name',
            'last_name', */
            'email',
            'phone',
            'position'
        ]));
    }
}
