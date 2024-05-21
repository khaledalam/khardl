<?php

namespace App\Http\Controllers\Web\Central\Admin\RestaurantOwner;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class RestaurantOwnerController extends Controller
{

    public function show(Request $request, User $user)
    {
        return view('admin.restaurant-owner.show', compact('user'));
    }
    public function update(Request $request, User $user)
    {

    }
}
