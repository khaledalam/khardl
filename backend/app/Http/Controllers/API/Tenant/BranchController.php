<?php

namespace App\Http\Controllers\API\Tenant;

use App\Http\Requests\API\Branch\UpdateBranchSettingsRequest;
use App\Models\Tenant\DeliveryType;
use App\Models\Tenant\Item;
use Illuminate\Http\Request;
use App\Models\Tenant\Branch;
use App\Traits\APIResponseTrait;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class BranchController extends Controller
{
    use APIResponseTrait;

    public function updateDelivery(UpdateBranchSettingsRequest $request, $branch)
    {
        $delivery_types = null;
        $user = Auth::user();
        $branch = Branch::where('id', $branch)
            ->findOrFail($user->branch->id);
        if($request->has('drivers_option') || $request->has('delivery_companies_option')){
            $flag = false;
            if ($request->has('drivers_option')) {
                if($request->input('drivers_option')==true)$flag = true;
                $updateData['drivers_option'] = $request->input('drivers_option');
            }
            if ($request->has('delivery_companies_option')) {
                if($request->input('delivery_companies_option')==true)$flag = true;
                $updateData['delivery_companies_option'] = $request->input('delivery_companies_option');
            }
            if($flag)$delivery_types[] = DeliveryType::where('name', DeliveryType::DELIVERY)->first()->id;
        }
        if ($request->has('pickup_availability')) {
            if($request->input('pickup_availability') == true){
                $delivery_types[] = DeliveryType::where('name', DeliveryType::PICKUP)->first()->id;
            }
            $updateData['pickup_availability'] = $request->input('pickup_availability');
        }
        if ($request->has('preparation_time_delivery')) {
            $updateData['preparation_time_delivery'] = $request->input('preparation_time_delivery');
        }
        $branch->delivery_types()->sync($delivery_types);
        $branch->update($updateData);
        return $this->sendResponse(null, __('Branch has been updated successfully.'));

    }

    public function getDeliveryAvailability($branch, Request $request)
    {
        $user = Auth::user();
        $branch = Branch::where('id', $branch)
            ->findOrFail($user->branch->id);

        return response()->json([
            'branch_id' => $user->branch->id,
            'preparation_time_delivery' => $branch->preparation_time_delivery,
            'availability' => $branch->delivery_availability,
            'pickup' => $branch->pickup_availability,
        ]);

    }

}
