<?php

namespace App\Repositories\API;

use App\Http\Resources\API\Tenant\CategoryResource;
use App\Http\Resources\API\Tenant\CategoryResourceCollection;
use App\Models\Tenant\Branch;
use App\Models\Tenant\Category;
use App\Utils\DefaultRepositoryPattern;
use Illuminate\Support\Facades\Auth;

class CategoryRepository extends DefaultRepositoryPattern
{
    public function __construct()
    {
        $user= Auth::user();
        $this->resource = new CategoryResource(new Category());
        // check is request coming from sancum
        if(request()->bearerToken()){
            $this->model = Category::where('branch_id',$user->branch->id)
            ->orderBy('created_at','DESC')
            ->orderBy('updated_at','DESC');
        }else {
            $this->model = Category::
            orderBy('created_at','DESC')
            ->orderBy('updated_at','DESC');
            if(request()->has('selected_branch_id')){
               if(Category::where('branch_id',request()->selected_branch_id)->exists()){
                    return $this->model->where('branch_id',request()->selected_branch_id);
               }else {
                    return $this->model->where('branch_id',Branch::where('is_primary',true)->first()->id);
               }
            }
        }
     
        
    }
    
}
