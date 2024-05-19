<?php

namespace App\Http\Services\Central\Admin\Advertisement;

use App\Enums\Admin\AdsRequestsStatusEnum;
use App\Models\AdsRequest;
use App\Models\AdvertisementPackage;


class AdvertisementService
{
    public function index($request)
    {
        $packages = AdvertisementPackage::withTrashed()
            ->orderBy('id', 'desc')
            ->get();
        $requestedPackages = AdsRequest::whenSearch($request['search']?? null)
            ->whenStatus($request['status']?? null)
            ->orderBy('id', 'desc')
            ->paginate(config('application.perPage'));
        $allStatus = AdsRequestsStatusEnum::values();
        return view('admin.advertisement.index', compact('packages', 'requestedPackages', 'allStatus'));
    }
    public function create($request)
    {
        return view('admin.advertisement.create');
    }
    public function edit($request, $advertisement)
    {
        return view('admin.advertisement.edit', compact('advertisement'));
    }
    public function store($request)
    {
        $data = $this->request_data($request);
        if ($request->hasFile('image')) {
            $data['image'] = $this->handleImage($request);
        }
        AdvertisementPackage::create($data);
        return redirect()->route('admin.advertisement.index')->with(['success' => __('Created successfully')]);
    }
    public function update($request, $advertisement)
    {
        $data = $this->request_data($request);
        if ($request->hasFile('image')) {
            $data['image'] = $this->handleImage($request);
        }
        $advertisement->update($data);
        return redirect()->route('admin.advertisement.index')->with(['success' => __('Updated successfully')]);
    }
    public function changeStatus($request, $adsRequest)
    {
        $adsRequest->update($request->only(['status']));
        if ($request->status == 'contacted') {
            $adsRequest->update(['answered_at' => now()]);
        }
        return redirect()->route('admin.advertisement.index')->with(['success' => __('Updated successfully')]);
    }
    public function destroy($advertisement)
    {
        $package = AdvertisementPackage::findOrFail($advertisement);
        $package->delete();
        return redirect()->route('admin.advertisement.index')->with(['success' => __('Deleted successfully')]);
    }
    public function handleImage($request, $update = null)
    {
        $image = store_image($request->file('image'), AdvertisementPackage::STORAGE, null, $update);
        return $image;
    }
    public function request_data($request)
    {
        return $request->only([
            'name',
            'description',
            'active'
        ]);
    }
}
