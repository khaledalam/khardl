<?php

namespace App\Http\Controllers\API\Tenant;

use App\Http\Controllers\API\Tenant\BaseRepositoryController;
use App\Repositories\CategoryRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
