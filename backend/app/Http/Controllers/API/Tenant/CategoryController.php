<?php

namespace App\Http\Controllers\API\Tenant;

use App\Http\Resources\API\Tenant\CategoryResource;
use App\Repositories\API\CategoryRepository;
use App\Http\Controllers\API\Tenant\BaseRepositoryController;

use App\Models\Tenant\Branch;
use App\Models\Tenant\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController
{
    protected $model;
    protected $resource;
    public function __construct()
    {
        $user = Auth::user();
        $this->resource = new CategoryResource(new Category());
        // check is request coming from sancum
        if (request()->bearerToken()) {
            $this->model = Category::whereHas('branch',function($q){
                    return $q->where("active",true);
                })->where('branch_id', $user->branch->id)
                ->orderBy('sort');
        } else {
            $this->model = Category::orderBy('sort');
            if (request()->has('selected_branch_id') && request()->selected_branch_id) {
                if (Category::where('branch_id', request()->selected_branch_id)->exists()) {
                  
                    // $this->model = $this->model->where('branch_id', request()->selected_branch_id);
                    $this->model = $this->model->whereHas('branch',function($q){
                        return $q->where("active",true);
                    })->where('branch_id', request()->selected_branch_id);
                } else {
//                    $this->model = $this->model->where('branch_id', Branch::where('is_primary', true)->first()->id);
                    $this->model = $this->model->whereHas('branch',function($q){
                        return $q->where("active",true);
                    });
                }
            }
        }


    }
    public function index(Request $request)
    {
        return $this->resource::collection($this->model->paginate());
    }

}
