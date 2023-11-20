<?php

namespace App\Http\Controllers\API\Tenant;

use App\Http\Controllers\API\Tenant\BaseRepositoryController;
use App\Repositories\CategoryRepository;

class CategoryController extends BaseRepositoryController
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->default_repository = new CategoryRepository();
            return $next($request);
        });
    }
   
}
