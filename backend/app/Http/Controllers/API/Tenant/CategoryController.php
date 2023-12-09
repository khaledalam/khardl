<?php

namespace App\Http\Controllers\API\Tenant;

use App\Repositories\API\CategoryRepository;
use App\Http\Controllers\API\Tenant\BaseRepositoryController;


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
