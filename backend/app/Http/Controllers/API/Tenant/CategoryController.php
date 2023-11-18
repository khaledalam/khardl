<?php

namespace App\Http\Controllers\API\Tenant;

use App\Http\Controllers\API\Tenant\BaseAPIController;
use App\Repositories\CategoryRepository;

class CategoryController extends BaseAPIController
{
    public function __construct()
    {
        $this->default_repository = new CategoryRepository();
    }
}
