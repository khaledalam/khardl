<?php

namespace App\Http\Controllers\API\Tenant;

use App\Http\Controllers\Controller;
use App\Utils\DefaultRepositoryPattern;

class BaseRepositoryController extends Controller
{
   protected DefaultRepositoryPattern $default_repository;
   public function index()
    {
        return $this->default_repository->all();
    }
}
