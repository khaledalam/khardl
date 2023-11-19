<?php

namespace App\Http\Controllers\API\Tenant;

use App\Http\Controllers\API\BaseController;
use App\Http\Controllers\Controller;
use App\Models\Tenant\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ItemController extends BaseController
{
   public function updateAvailability($item,Request $request){
        $request->validate([
            'availability' => 'required|boolean',
        ]);
        $user = Auth::user();
        $item = Item::
        where('user_id',$user->id)
        ->where('branch_id',$user->branch->id)
        ->findOrFail($item);
        $item->update(['availability'=>!$item->availability]);
        return $this->sendResponse(null, __('Item has been updated successfully.'));

   }
   
}
