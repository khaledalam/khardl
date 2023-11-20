<?php

namespace App\Repositories;

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
        $this->model = Category::where('branch_id',$user->branch->id);
        $this->resource = new CategoryResource($this->model);
    }
    
}
