<?php

namespace App\Http\Controllers\API\Tenant;

use App\Models\Tenant\Item;
use Illuminate\Http\Request;
use App\Models\Tenant\Branch;
use App\Traits\APIResponseTrait;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\API\BaseController;

class BranchController extends Controller
{
    use APIResponseTrait;

   public function updateDelivery($branch,Request $request){
        $request->validate([
            'delivery_availability' => 'required_without_all:preparation_time_delivery|boolean',
            'preparation_time_delivery'=>'required_without_all:delivery_availability|date_format:H:i'
        ]);
        $user = Auth::user();
        $branch = Branch::where('id',$branch)
        ->findOrFail($user->branch->id);
        if ($request->has('delivery_availability')) {
            $updateData['delivery_availability'] = $request->input('delivery_availability');
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
            'availability' => $branch->delivery_availability
        ]);

    }

}
