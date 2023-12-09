<?php

namespace App\Repositories\API;

use App\Http\Resources\API\Tenant\CategoryResource;
use App\Http\Resources\API\Tenant\CategoryResourceCollection;
use App\Models\Tenant\Category;
use App\Utils\DefaultRepositoryPattern;
use Illuminate\Support\Facades\Auth;

class CategoryRepository extends DefaultRepositoryPattern
{
    public function __construct()
    {
        $user= Auth::user();
        // check is request coming from sancum
        $this->model = Category::when(request()->bearerToken(), function ($query) use ($user) {
            return $query->where('branch_id',$user->branch->id);
        });
     
        $this->resource = new CategoryResource(new Category());
    }
    
}
