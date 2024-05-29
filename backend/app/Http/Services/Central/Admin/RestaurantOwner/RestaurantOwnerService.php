<?php

namespace App\Http\Services\Central\Admin\RestaurantOwner;

use App\Http\Controllers\API\Central\Auth\RegisterController;
use App\Http\Requests\Central\RestaurantOwner\CreateROFormRequest;
use Exception;
use Illuminate\Http\Request;
use App\Http\Requests\Central\RestaurantOwner\UpdateROFormRequest;
use App\Models\User;
use Illuminate\Support\Facades\DB;
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
        DB::beginTransaction();
        try {
            $user = User::create($this->request_data($request));
            $this->createOrUpdateTraderRequirements($user,$request,$optional = true);
            $tenant = $this->createRestaurant($user);
            return redirect()->route('admin.view-restaurants',['tenant' => $tenant->id])->with('success', __('Created successfully'));
        } catch (Exception $e) {
            DB::rollBack();
            \Sentry\captureException($e);
            return redirect()->back()->with('error', __('An error occurred'));
        }
    }
    public function request_data($request)
    {
        $data = $request->only(['first_name','last_name','position','email','password','dob','restaurant_name','restaurant_name_ar']);
        $data['first_name'] = $request->first_name ?? 'N/A';
        $data['last_name'] = $request->last_name ?? 'N/A';
        $data['position'] = $request->position ?? 'N/A';
        $data['password'] = $request->password ?? 'N/A';
        $data['email'] = $request->email ?? 'N/A@'.User::latest()->first()?->id + 1;
        $data['password'] = $request->password ? Hash::make($request->password): Hash::make('N/A');
        return $data;
    }
    public function update(UpdateROFormRequest $request, User $user)
    {
        try {
            $this->updateUserInfo($user,$request);
            if($user->traderRegistrationRequirement){
                $this->updateBD($request,$user);
                $this->createOrUpdateTraderRequirements($user,$request);
            }
            return redirect()->route('admin.restaurant-owner-management')->with('success', __('Updated successfully'));
        } catch (\Exception $e) {
            \Sentry\captureException($e);
            return redirect()->route('admin.restaurant-owner-management')->with('error', __('An error occurred'));
        }
    }
    public function createRestaurant($user)
    {
        $registerController = new RegisterController();
        return $registerController->createTenant($user);
    }
    public function createOrUpdateTraderRequirements($user,$request,$optional = null)
    {
        $registerController = new RegisterController();
        return $registerController->createOrUpdateTraderRequirements($user,$request,$optional);
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
        if($user->restaurant && $request->has('email')){
            $user->restaurant->update([
                'email' => $request->email
            ]);
        }
    }

}
