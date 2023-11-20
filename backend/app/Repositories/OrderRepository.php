<?php

namespace App\Repositories;

use App\Http\Resources\API\Tenant\CategoryResource;
use App\Http\Resources\API\Tenant\CategoryResourceCollection;
use App\Http\Resources\API\Tenant\OrderResource;
use App\Models\Tenant\Category;
use App\Models\Tenant\Order;
use App\Utils\DefaultRepositoryPattern;
use Illuminate\Support\Facades\Auth;

class OrderRepository extends DefaultRepositoryPattern
{
    public function __construct()
    {
        $user= Auth::user();
        $this->model = Order::where('user_id',$user->id)
        ->where('branch_id',$user->branch->id);
        $this->resource = new OrderResource($this->model);
    }
    
}
