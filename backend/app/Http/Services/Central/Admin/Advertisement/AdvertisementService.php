<?php

namespace App\Http\Services\Central\Admin\Advertisement;

use App\Models\AdvertisementPackage;


class AdvertisementService
{
    public function index($request)
    {
        $packages = AdvertisementPackage::withTrashed()
        ->orderBy('id','desc')
        ->paginate(config('application.perPage'));
        return view('admin.advertisement.index',compact('packages'));
    }
    public function create($request)
    {
        return view('admin.advertisement.create');
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
