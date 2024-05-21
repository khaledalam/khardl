<?php

namespace App\Http\Controllers\Web\Central\Admin\CompleteStepTwo;

use App\Actions\CreateTenantAction;
use App\Enums\Admin\LogTypes;
use App\Http\Controllers\API\Central\Auth\RegisterController;
use App\Http\Requests\Central\CompleteStepTwo\CompleteStepTwoFormRequest;
use App\Jobs\CreateTenantAdmin;
use App\Models\Log;
use App\Models\Tenant;
use App\Models\Tenant\RestaurantUser;
use App\Models\TraderRequirement;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

class CompleteStepTwoController extends Controller
{

    public function completeStepTwo(Request $request, User $user)
    {
        return view('admin.completeStepTwo.index', compact('user'));
    }
    public function storeStepTwo(CompleteStepTwoFormRequest $request, User $user)
    {
        $stepTwoMethod = new RegisterController();
        $stepTwoMethod->createNewRestaurant($user, $request);
        return redirect()->route('admin.restaurant-owner-management')->with('success',__('Restaurant has been created successfully'));
    }
}
