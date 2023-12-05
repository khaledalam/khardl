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

        // check is request coming from sancum
        $this->model = Category::when(request()->bearerToken(), static function ($query) use ($user) {
            if ($_GET['selected_branch_id']) {
//                $q->where()
                return $query->where('branch_id', $_GET['selected_branch_id']);

            }
        });

        $this->resource = new CategoryResource($this->model);
    }

}
