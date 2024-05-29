<?php

namespace App\Http\Services\Central\Admin\RestaurantOwner;

use App\Http\Controllers\API\Central\Auth\RegisterController;
use App\Http\Requests\Central\RestaurantOwner\CreateROFormRequest;
use Illuminate\Http\Request;
use App\Http\Requests\Central\RestaurantOwner\UpdateROFormRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
class RestaurantOwnerService
{
    public function show(Request $request, User $user)
    {
        return view('admin.restaurant-owner.show', compact('user'));
    }
    public function create(Request $request)
    {
        return view('admin.restaurant-owner.create');
    }
    public function store(CreateROFormRequest $request)
    {
        dd($request->all());
    }
    public function update(UpdateROFormRequest $request, User $user)
    {
        try {
            $this->updateUserInfo($user,$request);
            if($user->traderRegistrationRequirement){
                $this->updateBD($request,$user);
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
    public function updateBD($request, $user)
    {
        if ($request->has('dob')) {
            $user->dob = $request->dob;
            $user->save();
            $request->request->remove('dob');
        }
    }
    public function updateUserInfo($user,$request)
    {
        if ($request->has('password') && $request->password !=null) {
            $user->update(['password' => Hash::make($request['password'])]);
        }
        $user->update($request->only([
            'first_name',
            'last_name',
            'email',
            'phone',
            'position'
        ]));
    }

}
