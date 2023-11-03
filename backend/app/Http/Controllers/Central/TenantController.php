<?php

namespace App\Http\Controllers\Central;

use App\Models\User;
use Illuminate\Http\Request;
use App\Utils\ResponseHelper;
use App\Actions\CreateTenantAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateTenantRequest;

class TenantController  extends Controller
{
    public function store(CreateTenantRequest $request){
        $data = $request->validated();
        $domain = $data['domain'];
        unset($data['domain']);
        $tenant = (new CreateTenantAction)
        (
            data: $data,
            user: auth()->user(),
            domain: $domain
        );
        return ResponseHelper::responseWithData("Tenant has been created successfully",[
            // We impersonate user with id 1. This user will be created by the CreateTenantAdmin job.
            'url'=>$tenant->impersonationUrl(1)
        ], ResponseHelper::HTTP_OK);
    }
}
