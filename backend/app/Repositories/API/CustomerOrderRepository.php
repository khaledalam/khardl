<?php

namespace App\Repositories\API;

use App\Http\Resources\API\Tenant\CategoryResourceCollection;
use App\Http\Resources\API\Tenant\OrderResource;
use App\Models\Tenant\Order;
use App\Utils\DefaultRepositoryPattern;
use Illuminate\Support\Facades\Auth;

class CustomerOrderRepository extends DefaultRepositoryPattern
{
    public function __construct()
    {
        $user= Auth::user();
        $this->model = Order::where('user_id',$user->id)
        ->whenDateString(request('date') ?? null)
        ->orderBy('created_at','DESC')
        ->orderBy('updated_at','DESC');
        $this->resource = new OrderResource(new Order());
    }

}
