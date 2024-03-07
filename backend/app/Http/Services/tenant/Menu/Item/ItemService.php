<?php

namespace App\Http\Services\tenant\Menu\Item;

use App\Models\Tenant\Item;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
class ItemService
{
    public function show($request, $item)
    {
        return view('restaurant.view-item',compact('item'));
    }
    public function addItem($request, $id, $branchId)
    {

        // if(Auth::user()->id != DB::table('branches')->where('id', $branchId)->value('user_id')){
        //     return redirect()->route('restaurant.branches')->with('error', 'Unauthorized access');
        // }

        // DB::table('categories')->where('id', $id)->where('branch_id', $branchId)->value('user_id') == Auth::user()->id && $request->hasFile('photo')
        // TODO @todo validate the remain fields of the coming request

        if (!$request->validate([
            'item_name_en' => 'required|regex:/^[\p{Arabic}a-zA-Z\p{N}]+\h?[\p{N}\p{Arabic}a-zA-Z]*$/u',
            'item_name_ar' => 'required|regex:/^[\p{Arabic}a-zA-Z\p{N}]+\h?[\p{N}\p{Arabic}a-zA-Z]*$/u',
        ])) {
            return redirect()->back()->with('error', __('Invalid Product Name'));
        }
        // dd([
        // $request->checkboxInputNameEn,
        // $request->checkboxInputNameAr,

        // 'checkbox_required' => ( $request->input('checkbox_required'))?array_values( $request->input('checkbox_required')):null,
        // 'checkbox_input_titles' =>array_map(null,$request->checkboxInputTitleEn,$request->checkboxInputTitleAr),
        // 'checkbox_input_maximum_choices' =>$request->input('checkboxInputMaximumChoice'),
        // 'checkbox_input_names' => ($request->input('checkboxInputNameAr') )?  array_map(null,$request->checkboxInputNameEn,$request->checkboxInputNameAr) : null,
        // 'checkbox_input_prices' =>($request->input('checkboxInputPrice') )? array_values($request->input('checkboxInputPrice')) : null,
        // 'selection_required' =>( $request->input('selection_required'))?array_values( $request->input('selection_required')):null,
        // 'selection_input_names' =>($request->input('selectionInputNameAr') )? array_map(null,$request->selectionInputNameEn,$request->selectionInputNameAr) : null,
        // 'selection_input_prices' =>($request->input('selectionInputPrice') )? array_values($request->input('selectionInputPrice')) : null,
        // 'selection_input_titles' => array_map(null,$request->selectionInputTitleEn,$request->selectionInputTitleAr),
        // 'dropdown_required' =>( $request->input('dropdown_required'))?array_values( $request->input('dropdown_required')):null,
        // 'dropdown_input_titles' => array_map(null,$request->dropdownInputTitleEn,$request->dropdownInputTitleAr),
        // 'dropdown_input_names' =>($request->input('dropdownInputNameAr') )?array_map(null,$request->dropdownInputNameEn,$request->dropdownInputNameAr): null,
        // ]);

        if (DB::table('categories')->where('id', $id)->where('branch_id', $branchId)->value('user_id')) {

            $photoFile = $request->file('photo');

            $filename = Str::random(40) . '.' . $photoFile->getClientOriginalExtension();

            while (Storage::disk('public')->exists('items/' . $filename)) {
                $filename = Str::random(40) . '.' . $photoFile->getClientOriginalExtension();
            }

            $photoFile->storeAs('items', $filename, 'public');

            DB::beginTransaction();

            try {
                $itemData = [
                    'photo' => tenant_asset('items/' . $filename),
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
                    'category_id' => $id,
                    'user_id' => Auth::user()->id,
                    'availability' => ($request->input('availability')) ? true : false,
                    'branch_id' => $branchId,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
                Item::create($itemData);
                DB::commit();

                return redirect()->back()->with('success', 'Item successfully added.');
            } catch (\Exception $e) {
                logger($e->getMessage());
                DB::rollback();
                return redirect()->back()->with('error', $e->getMessage());
            }
        }
    }
    public function deleteItem($id)
    {
        $user = Auth::user();

        $selectedItem = DB::table('items')->where('id', $id)->first();

        if ($selectedItem && $user->id == $selectedItem->user_id) {

            DB::table('items')->where('id', $id)->delete();

            return redirect()->route('restaurant.get-category', ['id' => $selectedItem->category_id,'branchId' => $selectedItem->branch_id])->with('success', 'Item successfully deleted.');

        } else {
            return redirect()->back()->with('error', 'You are not authorized to access that page.');
        }
    }
    function processOptions($request, $enKey, $arKey)
    {
        return $request->input($arKey)
            ? array_map(function ($en, $ar) {
                return array_map(function ($en, $ar) {
                    return [$en, $ar];
                }, $en, $ar);
            }, $request->$enKey, $request->$arKey)
            : null;
    }
}
