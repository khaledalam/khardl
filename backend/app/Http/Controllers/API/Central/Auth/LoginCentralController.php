<?php

namespace App\Http\Controllers\API\Central\Auth;

use App\Http\Controllers\API\Tenant\Auth\LoginController;
use App\Models\Tenant;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\API\BaseController;

class LoginCentralController extends BaseController
{
    public function login(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email|min:10|max:255',
            'password' => 'required|string|min:6|max:255',
            'remember_me' => 'nullable|boolean',
            'login_code' => 'required|string|min:5|max:5',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }


        $tenant = Tenant::whereJsonContains('data->mapper_hash', $request->code)->first();
        if (!$tenant) {
            return $this->sendError(__('Validation Error. R!'));
        }

        return $tenant->run(function () use($request) {
            return (new LoginController())->login($request);
        });
    }

    public function logout(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'login_code' => 'required|string|min:5|max:5',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $tenant = Tenant::whereJsonContains('data->mapper_hash', $request->code)->first();
        if (!$tenant) {
            return $this->sendError(ــ('Validation Error. R!'));
        }

        return $tenant->run(function () use($request) {
            return (new LoginController())->logout($request);
        });
    }
}
