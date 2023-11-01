<?php

namespace App\Http\Controllers\Central;

use Illuminate\Http\Request;
use App\Actions\CreateTenantAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateTenantRequest;
use App\Models\User;

class TenantController  extends Controller
{
    public function store(CreateTenantRequest $request){
        $data = $request->validated();
        unset($data['domain']);

        $tenant = (new CreateTenantAction)
        (
            data: $data,
            user: User::find(2),
            domain: $request->domain
        );
       
        // We impersonate user with id 1. This user will be created by the CreateTenantAdmin job.
        return $tenant->impersonationUrl(1);
    }
}
