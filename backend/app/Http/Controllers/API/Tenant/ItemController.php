<?php

namespace App\Http\Controllers\API\Tenant;

use App\Models\Tenant\Item;
use Illuminate\Http\Request;
use App\Traits\APIResponseTrait;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;


class ItemController extends Controller
{
   use APIResponseTrait;
   public function updateAvailability($item,Request $request){
        $request->validate([
            'availability' => 'required|boolean',
        ]);
        $user = Auth::user();
        $item = Item::where('branch_id',$user->branch->id)
        ->findOrFail($item);
        $item->update(['availability'=>!$item->availability]);
        return $this->sendResponse(null, __('Item has been updated successfully.'));

   }
   
}
