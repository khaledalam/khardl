<?php

namespace App\Http\Controllers\API\Tenant;

use App\Http\Controllers\Controller;
use App\Utils\DefaultRepositoryPattern;
use Illuminate\Http\Request;

class BaseRepositoryController extends Controller
{
   protected DefaultRepositoryPattern $default_repository;
   public function index(Request $request)
    {
        return $this->default_repository->all($request);
    }
}
