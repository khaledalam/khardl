<?php

namespace App\Interfaces;use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

interface CrudInterface
{
    public function all(Request $request);
}

