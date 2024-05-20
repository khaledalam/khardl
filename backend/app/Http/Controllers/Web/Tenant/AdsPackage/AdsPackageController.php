<?php

namespace App\Http\Controllers\Web\Tenant\AdsPackage;

use App\Http\Controllers\Web\BaseController;
use App\Http\Requests\Tenant\AdsPackage\RequestForAdsPackageRequest;
use App\Http\Services\tenant\AdsPackage\AdsPackageService;
use Illuminate\Http\Request;


class AdsPackageController extends BaseController
{
    public function __construct(
        private AdsPackageService $adsPackageService
    ) {
    }
    public function index(Request $request)
    {
        return $this->adsPackageService->index($request);
    }
    public function store(RequestForAdsPackageRequest $request, $advertisement)
    {
        return $this->adsPackageService->store($request,$advertisement);
    }
}
