<?php

namespace App\Http\Controllers\Web\Central\Admin\Advertisement;

use App\Http\Controllers\Controller;
use App\Http\Requests\Central\Advertisement\CreateAdvertisementPackageRequest;
use App\Http\Services\Central\Admin\Advertisement\AdvertisementService;
use Illuminate\Http\Request;

class AdvertisementController extends Controller

{
    public function __construct(private AdvertisementService $advertisementService) {
    }
    public function index(Request $request)
    {
        return $this->advertisementService->index($request);
    }
    public function create(Request $request)
    {
        return $this->advertisementService->create($request);
    }
    public function store(CreateAdvertisementPackageRequest $request)
    {
        return $this->advertisementService->store($request);
    }
    public function destroy(Request $request, $advertisement)
    {
        return $this->advertisementService->destroy($advertisement);
    }
}
