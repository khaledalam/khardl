<?php

namespace App\Http\Controllers\API\Tenant\Driver\Profile;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Web\BaseController;

use App\Http\Requests\API\Driver\Profile\ChangePasswordRequest;
use App\Http\Requests\API\Driver\Profile\UpdateImageRequest;
use App\Http\Services\API\tenant\Driver\Profile\ProfileService;
use Illuminate\Http\Request;


class ProfileController extends BaseController
{
    public function __construct(private ProfileService $profileService) {
    }
    public function changePassword(ChangePasswordRequest $request)
    {
        return $this->profileService->changePassword($request);
    }
    public function getProfile(Request $request)
    {
        return $this->profileService->getProfile();
    }
    public function updateImage(UpdateImageRequest $request)
    {
        return $this->profileService->updateImage($request);
    }
}
