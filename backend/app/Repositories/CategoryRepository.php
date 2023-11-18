<?php

namespace App\Repositories;

use App\Http\Resources\API\Tenant\CategoryResource;
use App\Http\Resources\API\Tenant\CategoryResourceCollection;
use App\Models\Tenant\Category;
use App\Utils\DefaultRepositoryPattern;

class CategoryRepository extends DefaultRepositoryPattern
{
    public function __construct()
    {
        $this->model = new Category();
        $this->resource = new CategoryResource($this->model);
    }
}
