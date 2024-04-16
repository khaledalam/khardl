<?php

namespace App\Http\Controllers\Web\Tenant\Menu\Item;

use App\Http\Controllers\Web\BaseController;
use App\Http\Requests\Tenant\Menu\UpdateItemFormRequest;
use App\Http\Services\tenant\Menu\Item\ItemService;
use App\Http\Services\tenant\Restaurant\RestaurantService;
use App\Models\Tenant\Item;
use Illuminate\Http\Request;


class ItemController extends BaseController
{
    public function __construct(
        private ItemService $itemService
    ) {
    }
    public function show(Request $request, Item $item)
    {
        return $this->itemService->show($request, $item);
    }
    public function store(Request $request, $id, $branchId)
    {
        return $this->itemService->addItem($request, $id, $branchId);
    }
    public function update(UpdateItemFormRequest $request, Item $item)
    {
        return $this->itemService->update($request, $item);
    }
    public function delete($id)
    {
        return $this->itemService->deleteItem($id);
    }

    public function edit(Request $request, Item $item)
    {
        return $this->itemService->edit($request,$item);
    }
}
