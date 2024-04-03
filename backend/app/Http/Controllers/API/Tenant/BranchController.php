<?php

namespace App\Http\Controllers\API\Tenant;

use App\Http\Requests\API\Branch\UpdateBranchSettingsRequest;
use App\Models\Tenant\Item;
use Illuminate\Http\Request;
use App\Models\Tenant\Branch;
use App\Traits\APIResponseTrait;
use App\Http\Controllers\Controller;
use App\Models\Tenant\DeliveryType;
use Illuminate\Support\Facades\Auth;

class BranchController extends Controller
{
    use APIResponseTrait;

   public function updateDelivery(UpdateBranchSettingsRequest $request,$branch){
        $user = Auth::user();
        $branch = Branch::where('id',$branch)
        ->findOrFail($user->branch->id);

        // if ($request->has('delivery_availability')) {
        //     $deliveryTypeId = DeliveryType::where("name",DeliveryType::DELIVERY)->first()->id;
        //     if($request->delivery_availability){
        //         $branch->delivery_types()->syncWithoutDetaching($deliveryTypeId);
        //     }else {
        //         $branch->delivery_types()->detach($deliveryTypeId);
        //     }
        // }
        // if ($request->has('pickup_availability')) {
        //     $pickupId = DeliveryType::where("name",DeliveryType::PICKUP)->first()->id;
        //     if($request->pickup_availability){

        //         $branch->delivery_types()->syncWithoutDetaching($pickupId);
        //     }else {
        //         $branch->delivery_types()->detach($pickupId);
        //     }
        // }
        if ($request->has('delivery_availability')) {
            $updateData['delivery_availability'] = $request->input('delivery_availability');
        }
       if ($request->has('pickup_availability')) {
           $updateData['pickup_availability'] = $request->input('pickup_availability');
       }
        if ($request->has('preparation_time_delivery')) {
            $updateData['preparation_time_delivery'] = $request->input('preparation_time_delivery');
        }

        $branch->update($updateData);
        return $this->sendResponse(null, __('Branch has been updated successfully.'));

   }

    public function getDeliveryAvailability($branch,Request $request){
        $user = Auth::user();
        $branch = Branch::where('id',$branch)
            ->findOrFail($user->branch->id);

        return response()->json([
            'branch_id' => $user->branch->id,
            'preparation_time_delivery' => $branch->preparation_time_delivery,
            'availability' => $branch->delivery_availability,
            'pickup' => $branch->pickup_availability,
        ]);

    }

}
