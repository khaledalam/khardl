<?php

namespace App\Http\Controllers\API\Tenant;

use Illuminate\Http\Request;
use App\Utils\ResponseHelper;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Utils\DefaultRepositoryPattern;

class BaseAPIController extends Controller
{
   protected DefaultRepositoryPattern $default_repository;

   public function index(){
        return $this->default_repository->all();
   }
}
