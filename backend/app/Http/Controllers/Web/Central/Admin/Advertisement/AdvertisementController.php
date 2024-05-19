<?php

namespace App\Http\Controllers\Web\Central\Admin\Advertisement;

use App\Http\Controllers\Controller;
use App\Http\Requests\Central\Advertisement\AdvertisementPackageFormRequest;
use App\Http\Requests\Central\Advertisement\ChangeStatusAdvertisementRequest;
use App\Http\Services\Central\Admin\Advertisement\AdvertisementService;
use App\Models\AdsRequest;
use App\Models\AdvertisementPackage;
use Illuminate\Http\Request;

class AdvertisementController extends Controller

{
    public function __construct(private AdvertisementService $advertisementService) {
        $this->middleware('permission:can_access_advertisements');
    }
    public function index(Request $request)
    {
        return $this->advertisementService->index($request);
    }
    public function create(Request $request)
    {
        return $this->advertisementService->create($request);
    }
    public function store(AdvertisementPackageFormRequest $request)
    {
        return $this->advertisementService->store($request);
    }
    public function update(AdvertisementPackageFormRequest $request,AdvertisementPackage $advertisement)
    {
        return $this->advertisementService->update($request,$advertisement);
    }
    public function edit(Request $request, AdvertisementPackage $advertisement)
    {
        return $this->advertisementService->edit($request,$advertisement);
    }
    public function changeStatus(ChangeStatusAdvertisementRequest $request, AdsRequest $adsRequest)
    {
        return $this->advertisementService->changeStatus($request,$adsRequest);
    }
    public function destroy(Request $request, $advertisement)
    {
        return $this->advertisementService->destroy($advertisement);
    }
}
