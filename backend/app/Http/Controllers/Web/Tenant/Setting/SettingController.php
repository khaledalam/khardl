<?php

namespace App\Http\Controllers\Web\Tenant\Setting;

use App\Http\Controllers\Web\BaseController;
use App\Http\Requests\Tenant\Setting\SettingUpdateFormRequest;
use App\Http\Services\tenant\Setting\SettingService;
use Illuminate\Http\Request;

class SettingController extends BaseController
{
    public function __construct(private SettingService $settingService) {
    }
    public function settings()
    {
        return $this->settingService->get();
    }

    public function updateSettings(SettingUpdateFormRequest $request)
    {
        return $this->settingService->update($request);
    }
}
