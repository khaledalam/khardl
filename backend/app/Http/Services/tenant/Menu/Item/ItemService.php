<?php

namespace App\Http\Services\tenant\Menu\Item;

use App\Http\Requests\Tenant\Menu\ItemFormRequest;
use App\Models\Tenant\CartItem;
use App\Models\Tenant\Item;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ItemService
{
    public function show($request, $item)
    {
        return view('restaurant.view-item', compact('item'));
    }
    public function addItem(ItemFormRequest $request, $id, $branchId)
    {
        if (DB::table('categories')->where('id', $id)->where('branch_id', $branchId)->value('user_id')) {

            $photoFile = $request->file('photo');
            $path = store_image($photoFile, 'items');

            DB::beginTransaction();

            try {
                $itemData = [
                    'photo' => $path,
                    'price' => $request->input('price'),
                    'calories' => $request->input('calories'),
                    'name' => trans_json($request->input('item_name_en'), $request->input('item_name_ar')),
                    'description' => ($request->input('description_en')) ? trans_json($request->input('description_en'), $request->input('description_ar')) : null,
                    'checkbox_required' => ($request->input('checkbox_required')) ? array_values($request->input('checkbox_required')) : null,
                    'checkbox_input_titles' => ($request->checkboxInputTitleEn) ? array_map(null, $request->checkboxInputTitleEn, $request->checkboxInputTitleAr) : null,
                    'checkbox_input_maximum_choices' => $request->input('checkboxInputMaximumChoice'),
                    'checkbox_input_names' => $this->processOptions($request, 'checkboxInputNameEn', 'checkboxInputNameAr'),
                    'checkbox_input_prices' => $request->input('checkboxInputPrice') ? array_values($request->input('checkboxInputPrice')) : null,
                    'selection_required' => $request->input('selection_required') ? array_values($request->input('selection_required')) : null,
                    'selection_input_names' => $this->processOptions($request, 'selectionInputNameEn', 'selectionInputNameAr'),
                    'selection_input_prices' => $request->input('selectionInputPrice') ? array_values($request->input('selectionInputPrice')) : null,
                    'selection_input_titles' => (isset($request->selectionInputTitleEn)) ? array_map(null, $request->selectionInputTitleEn, $request->selectionInputTitleAr) : null,
                    'dropdown_required' => ($request->input('dropdown_required')) ? array_values($request->input('dropdown_required')) : null,
                    'dropdown_input_titles' => (isset($request->dropdownInputTitleEn)) ? array_map(null, $request->dropdownInputTitleEn, $request->dropdownInputTitleAr) : null,
                    'dropdown_input_names' => $this->processOptions($request, 'dropdownInputNameEn', 'dropdownInputNameAr'),
                    'dropdown_input_prices' => $request->input('dropdownInputPrice') ? array_values($request->input('dropdownInputPrice')) : null,
                    'allow_buy_with_loyalty_points' => ($request->input('allow_buy_with_loyalty_points') ? true : false),
                    'price_using_loyalty_points' => $request->input('price_using_loyalty_points') ?? 0,
                    'category_id' => $id,
                    'user_id' => Auth::user()->id,
                    'availability' => ($request->input('availability')) ? true : false,
                    'branch_id' => $branchId,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
                Item::create($itemData);
                DB::commit();

                return redirect()->back()->with('success', __('Item successfully added.'));
            } catch (\Exception $e) {
                logger($e->getMessage());
                DB::rollback();
                return redirect()->back()->with('error', $e->getMessage());
            }
        }
    }
    public function update(ItemFormRequest $request, Item $item)
    {
        DB::beginTransaction();
        try {
            $photoFile = $request->file('photo');

            if ($photoFile) {
                $item->photo = store_image($photoFile, 'items', null, $item->photo);
            }

            $item->price = $request->input('price');
            $item->allow_buy_with_loyalty_points = ($request->input('allow_buy_with_loyalty_points') ? true : false);
            $item->price_using_loyalty_points = $request->input('price_using_loyalty_points');
            $item->calories = $request->input('calories');
            $item->name = trans_json($request->input('item_name_en'), $request->input('item_name_ar'));
            $item->description = trans_json($request->input('description_en'), $request->input('description_ar'));
            $item->checkbox_required = ($request->input('checkbox_required')) ? array_values($request->input('checkbox_required')) : null;
            $item->checkbox_input_titles = ($request->checkboxInputTitleEn) ? array_map(null, $request->checkboxInputTitleEn, $request->checkboxInputTitleAr) : null;
            $item->checkbox_input_maximum_choices = $request->input('checkboxInputMaximumChoice');
            $item->checkbox_input_names = $this->processOptions($request, 'checkboxInputNameEn', 'checkboxInputNameAr');
            $item->checkbox_input_prices = $request->input('checkboxInputPrice') ? array_values($request->input('checkboxInputPrice')) : null;
            $item->selection_required = $request->input('selection_required') ? array_values($request->input('selection_required')) : null;
            $item->selection_input_names = $this->processOptions($request, 'selectionInputNameEn', 'selectionInputNameAr');
            $item->selection_input_prices = $request->input('selectionInputPrice') ? array_values($request->input('selectionInputPrice')) : null;
            $item->selection_input_titles = (isset($request->selectionInputTitleEn)) ? array_map(null, $request->selectionInputTitleEn, $request->selectionInputTitleAr) : null;
            $item->dropdown_required = ($request->input('dropdown_required')) ? array_values($request->input('dropdown_required')) : null;
            $item->dropdown_input_titles = (isset($request->dropdownInputTitleEn)) ? array_map(null, $request->dropdownInputTitleEn, $request->dropdownInputTitleAr) : null;
            $item->dropdown_input_names = $this->processOptions($request, 'dropdownInputNameEn', 'dropdownInputNameAr');
            $item->dropdown_input_prices = $request->input('dropdownInputPrice') ? array_values($request->input('dropdownInputPrice')) : null;
            $item->availability = ($request->input('availability')) ? true : false;
            $item->save();
            $this->removeItemFromCart($item->id);
            DB::commit();
            return redirect()->back()->with('success', __('Item successfully updated.'));
        } catch (\Exception $e) {
            \Sentry\captureException($e);
            DB::rollback();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
    public function removeItemFromCart($item_id)
    {
        CartItem::where('item_id', $item_id)->delete();
    }
    public function deleteItem($id)
    {
        $user = Auth::user();



        $selectedItem = DB::table('items')->where('id', $id)->first();

        if ($user->isRestaurantOwner() || ($selectedItem && $user->id == $selectedItem->user_id)) {

            DB::table('items')->where('id', $id)->delete();

            return redirect()->route('restaurant.get-category', ['id' => $selectedItem->category_id, 'branchId' => $selectedItem->branch_id])->with('success', __('Item successfully deleted.'));

        } else {
            return redirect()->back()->with('error', 'You are not authorized to access that page.');
        }
    }
    public function edit($request, $item)
    {
        return view('restaurant.edit-item', compact('item'));
    }
    function processOptions($request, $enKey, $arKey)
    {
        return $request->input($arKey)
            ? array_map(function ($en, $ar) {
                return array_map(function ($en, $ar) {
                    return [$en, $ar];
                }, array_filter($en, fn($value) => $value != null), array_filter($ar, fn($value) => $value != null));
            }, $request->$enKey, $request->$arKey)
            : null;
    }
}
