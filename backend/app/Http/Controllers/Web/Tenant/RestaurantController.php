<?php

namespace App\Http\Controllers\Web\Tenant;

use App\Models\Tenant\Item;
use Illuminate\Support\Str;
use App\Models\Tenant\Order;
use Illuminate\Http\Request;
use App\Models\Tenant\Branch;
use App\Models\Tenant\Setting;
use Illuminate\Support\Carbon;
use App\Models\Tenant\Category;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use App\Models\Tenant\DeliveryType;
use App\Models\Tenant\PaymentMethod;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Tenant\RestaurantUser;
use App\Models\Tenant\OrderStatusLogs;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Web\BaseController;
use App\Http\Requests\RegisterWorkerRequest;
use App\Models\Subscription;
use App\Packages\DeliveryCompanies\Yeswa\Yeswa;
use Illuminate\Contracts\Database\Query\Builder;
use App\Http\Services\tenant\Restaurant\RestaurantService;
use App\Models\Tenant\DeliveryCompany;
use App\Packages\DeliveryCompanies\Cervo\Cervo;
use App\Packages\DeliveryCompanies\StreetLine\StreetLine;

class RestaurantController extends BaseController
{
    public function __construct(
        private RestaurantService $restaurantService
      ) {
    }
    public function index(){

        return $this->restaurantService->index();
    }

    public function services(){
        /** @var RestaurantUser $user */
        $user = Auth::user();
        $branches = Branch::all();
        $subscription = tenancy()->central(function(){
            return Subscription::first();
        });

        return view('restaurant.service', compact('user', 'branches','subscription'));
    }

    public function delivery(){
        /** @var RestaurantUser $user */
        $user = Auth::user();
        $yeswa = DeliveryCompany::where("module",class_basename(Yeswa::class))->first();
        $cervo = DeliveryCompany::where("module",class_basename(Cervo::class))->first();
        $streetline = DeliveryCompany::where("module",class_basename(StreetLine::class))->first();

        return view('restaurant.delivery',
            compact('user','streetline','yeswa','cervo'));
    }

    public function promotions(){
        /** @var RestaurantUser $user */
        $user = Auth::user();

        $settings = Setting::all()->firstOrFail();

        return view('restaurant.promotions',
            compact('user', 'settings'));
    }

    public function updatePromotions(Request $request){

        $request->validate([
            'loyalty_points' => 'required|numeric|min:0',
            'loyalty_point_price' => 'required|numeric|min:0',
            'cashback_threshold' => 'required|numeric|min:0',
            'cashback_percentage' => 'required|numeric|min:0',
        ]);

        $settings = Setting::all()->firstOrFail();

        $settings->loyalty_points = $request->loyalty_points;
        $settings->loyalty_point_price = $request->loyalty_point_price;
        $settings->cashback_threshold = $request->cashback_threshold;
        $settings->cashback_percentage = $request->cashback_percentage;
        $settings->save();

        return redirect()->back()->with('success', __('Restaurant promotions successfully updated.'));
    }

    public function settings(){
        /** @var RestaurantUser $user */
        $user = Auth::user();

        $settings = Setting::all()->firstOrFail();

        return view('restaurant.settings',
            compact('user', 'settings'));
    }

    public function updateSettings(Request $request){

        $request->validate([
            'delivery_fee' => 'required|numeric|min:0',
        ]);

        $settings = Setting::all()->firstOrFail();

        $settings->delivery_fee = $request->delivery_fee;
        $settings->save();

        $delivery = DeliveryType::where('name', DeliveryType::DELIVERY)->first();

        if ($delivery) {
            $delivery->cost = $settings->delivery_fee;
            $delivery->save();
        }

        return redirect()->back()->with('success', __('Restaurant settings successfully updated.'));
    }

    public function settingsBranch(Branch $branch){
        /** @var RestaurantUser $user */
        $user = Auth::user();
        $payment_methods = $branch->payment_methods->pluck('id','name');
        $delivery_types = $branch->delivery_types->pluck('id','name');

        return view('restaurant.settings_branch',
            compact('user','branch','payment_methods', 'delivery_types'));
    }

    public function updateSettingsBranch(Branch $branch,Request $request){
        $payment_methods = null;
        $delivery_types = null;
        foreach($request->payment_methods ?? [] as $method){
            $payment_methods [] = PaymentMethod::where('name',$method)->first()->id;
        }
        foreach($request->delivery_types ?? [] as $method){
            $delivery_types [] = DeliveryType::where('name',$method)->first()->id;
        }
        $branch->payment_methods()->sync($payment_methods);
        $branch->delivery_types()->sync($delivery_types);

      return redirect()->back()->with('success', __('Branch settings successfully updated.'));

    }




    public function orders_all(){
        /** @var RestaurantUser $user */
        $user = Auth::user();
        $orders =  Order::orderBy('created_at','DESC')->paginate(10);
        return view('restaurant.orders_all',
            compact('user','orders'));
    }

    public function orders_add(){
        /** @var RestaurantUser $user */
        $user = Auth::user();

        return view('restaurant.orders_add',
            compact('user'));
    }

    public function branchOrders(Order $order){

        $user = Auth::user();
        $order->load('user','items');

        $orderStatusLogs = OrderStatusLogs::all()->sortByDesc("created_at");
        $locale = app()->getLocale();
        return view('restaurant.orders.show',
            compact('user','order','locale','orderStatusLogs'));
    }


    public function qr(){
        /** @var RestaurantUser $user */
        $user = Auth::user();

        return view('restaurant.qr',
            compact('user'));
    }



    public function branches(){
        $user = Auth::user();
        $available_branches = $user->number_of_available_branches();
        $branches =  DB::table('branches')
        ->when($user->isWorker(), function (Builder $query, string $role)use($user) {
            $query->where('id', $user->branch->id);
        })
        ->get()
        ->sortByDesc('is_primary');

        return view(($user->isRestaurantOwner())?'restaurant.branches':'worker.branches',
        compact('available_branches','user', 'branches')); //view('branches')
    }

    public function branches_site_editor(){
        $user = Auth::user();

        if (!$user->isRestaurantOwner()) {
            return $this->sendResponse(null, 'Bad request');
        }

        $branches =  DB::table('branches')
            ->get(['id', 'is_primary', 'name'])
            ->sortByDesc('is_primary');

        return $this->sendResponse($branches, 'Fetched branches successfully');

    }

    public function addBranch(Request $request){

        if(!$this->can_create_branch()){

            return redirect()->back()->with('error', 'Not allowed to create branch');
        }

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string',
            'address' => 'required|string',
            'location' => 'required',
            'copy_menu' => 'required',
            'normal_from' => [ Rule::when($request->hours_option == 'normal','date_format:H:i')],
            'normal_to' => [ Rule::when($request->hours_option == 'normal','date_format:H:i|after:normal_from')],
            'saturday_open' => [ Rule::when($request->hours_option == 'custom','date_format:H:i')],
            'saturday_close' => [ Rule::when($request->hours_option == 'custom','date_format:H:i|after:saturday_open')],
            'sunday_open' => [ Rule::when($request->hours_option == 'custom','date_format:H:i')],
            'sunday_close' => [ Rule::when($request->hours_option == 'custom','date_format:H:i|after:sunday_open')],
            'monday_open' => [ Rule::when($request->hours_option == 'custom','date_format:H:i')],
            'monday_close' => [ Rule::when($request->hours_option == 'custom','date_format:H:i|after:monday_open')],
            'tuesday_open' => [ Rule::when($request->hours_option == 'custom','date_format:H:i')],
            'tuesday_close' => [ Rule::when($request->hours_option == 'custom','date_format:H:i|after:tuesday_open')],
            'wednesday_open' => [ Rule::when($request->hours_option == 'custom','date_format:H:i')],
            'wednesday_close' => [ Rule::when($request->hours_option == 'custom','date_format:H:i|after:wednesday_open')],
            'thursday_open' => [ Rule::when($request->hours_option == 'custom','date_format:H:i')],
            'thursday_close' => [ Rule::when($request->hours_option == 'custom','date_format:H:i|after:thursday_open')],
            'friday_open' => [ Rule::when($request->hours_option == 'custom','date_format:H:i')],
            'friday_close' => [ Rule::when($request->hours_option == 'custom','date_format:H:i|after:friday_open')],
        ]);

        list($lat, $lng) = explode(' ', $validatedData['location']);

        $branchesExist = DB::table('branches')->where('is_primary',1)->exists();

        $time = function($time,$open = true)use($request){
            if($request->hours_option == 'normal'){
                if($open)
                    return  Carbon::createFromFormat('H:i', $request->input('normal_from'))->format('H:i');
                else
                    return  Carbon::createFromFormat('H:i', $request->input('normal_to'))->format('H:i');
            }else {
                return  Carbon::createFromFormat('H:i', $time)->format('H:i');
            }
        };

        $newBranchId = DB::table('branches')->insertGetId([
            'name' => $validatedData['name'],
            'phone' => $validatedData['phone'],
            'address'=> $validatedData['address'],
            'lat' => (float) $lat,
            'lng' => (float) $lng,

            'is_primary' => !$branchesExist,
            'saturday_open' => $time( $request->input('saturday_open')),
            'saturday_close' => $time( $request->input('saturday_close'),false),
            'sunday_open' =>$time( $request->input('sunday_open')),
            'sunday_close' =>$time( $request->input('sunday_close'),false),
            'monday_open' =>$time( $request->input('monday_open')),
            'monday_close' => $time( $request->input('monday_close'),false),
            'tuesday_open' =>$time( $request->input('tuesday_open')),
            'tuesday_close' => $time( $request->input('tuesday_close'),false),
            'wednesday_open' => $time( $request->input('wednesday_open')),
            'wednesday_close' => $time( $request->input('wednesday_close'),false),
            'thursday_open' =>$time( $request->input('thursday_open')),
            'thursday_close' =>$time( $request->input('thursday_close'),false),
            'friday_open' => $time( $request->input('friday_open')),
            'friday_close' => $time( $request->input('friday_close'),false),
        ]);

        if ($validatedData['copy_menu'] != "None") {

            $categories = DB::table('categories')->where('branch_id', $validatedData['copy_menu'])->get();
            foreach ($categories as $category) {
                DB::table('categories')->insert([
                    'branch_id' => $newBranchId,
                    'name' => $category->name,
                    'user_id' => Auth::user()->id,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);

                $newCategoryId = DB::getPdo()->lastInsertId();

                $items = DB::table('items')->where('category_id', $category->id)->get();
                foreach ($items as $item) {
                    $newFilename = Str::uuid()->toString() . '.' . pathinfo($item->photo, PATHINFO_EXTENSION);
                    Item::create([
                        'branch_id' => $newBranchId,
                        'category_id' => $newCategoryId,
                        'photo' => tenant_asset($newFilename),
                        'price' => $item->price,
                        'calories' => $item->calories,
                        'name' => $item->name,
                        'description' => $item->description ?? null,
                        'checkbox_required' => $item->checkbox_required,
                        'checkbox_input_titles' => $item->checkbox_input_titles,
                        'checkbox_input_maximum_choices' => $item->checkbox_input_maximum_choices,
                        'checkbox_input_names' => $item->checkbox_input_names,
                        'checkbox_input_prices' => $item->checkbox_input_prices,
                        'selection_required' => $item->selection_required,
                        'selection_input_names' => $item->selection_input_names,
                        'selection_input_prices' => $item->selection_input_prices,
                        'selection_input_titles' => $item->selection_input_titles,
                        'dropdown_required' => $item->dropdown_required,
                        'dropdown_input_titles' =>$item->dropdown_input_titles,
                        'dropdown_input_names' => $item->dropdown_input_names,
                        'user_id' => Auth::user()->id
                    ]);


                    $sourcePath = storage_path("{$item->photo}");
                    $destinationPath = storage_path("{$newFilename}");

                    if (file_exists($sourcePath)) {
                        $destinationPath = str_replace('/', DIRECTORY_SEPARATOR, $destinationPath);
                        Storage::disk('local')->copy($sourcePath, $destinationPath);
                    }

                }
            }
        }

        return redirect()->back()->with('success', 'Branch successfully added.');

    }
    private function can_create_branch(){
        // redirect to payment gateway
        $setting = Setting::first();
        if($setting->branch_slots == 0){
            return false;
        }else {
            $setting->update([
                'branch_slots'=> DB::raw('branch_slots - 1'),
            ]);
            return true;
        }

    }


    public function updateBranch(Request $request, $id)
    {
        // if(Auth::user()->id != DB::table('branches')->where('id', $id)->value('user_id'))
        //     return;

        $validatedData = $request->validate([
            'saturday_open' => 'required|date_format:H:i',
            'saturday_close' => 'required|date_format:H:i|after:saturday_open',
            'sunday_open' => 'required|date_format:H:i',
            'sunday_close' => 'required|date_format:H:i|after:sunday_open',
            'monday_open' => 'required|date_format:H:i',
            'monday_close' => 'required|date_format:H:i|after:monday_open',
            'tuesday_open' => 'required|date_format:H:i',
            'tuesday_close' => 'required|date_format:H:i|after:tuesday_open',
            'wednesday_open' => 'required|date_format:H:i',
            'wednesday_close' => 'required|date_format:H:i|after:wednesday_open',
            'thursday_open' => 'required|date_format:H:i',
            'thursday_close' => 'required|date_format:H:i|after:thursday_open',
            'friday_open' => 'required|date_format:H:i',
            'friday_close' => 'required|date_format:H:i|after:friday_open',
        ]);

        $formattedData = [
            'saturday_open' => Carbon::createFromFormat('H:i', $validatedData['saturday_open'])->format('H:i'),
            'saturday_close' => Carbon::createFromFormat('H:i', $validatedData['saturday_close'])->format('H:i'),
            'sunday_open' => Carbon::createFromFormat('H:i', $validatedData['sunday_open'])->format('H:i'),
            'sunday_close' => Carbon::createFromFormat('H:i', $validatedData['sunday_close'])->format('H:i'),
            'monday_open' => Carbon::createFromFormat('H:i', $validatedData['monday_open'])->format('H:i'),
            'monday_close' => Carbon::createFromFormat('H:i', $validatedData['monday_close'])->format('H:i'),
            'tuesday_open' => Carbon::createFromFormat('H:i', $validatedData['tuesday_open'])->format('H:i'),
            'tuesday_close' => Carbon::createFromFormat('H:i', $validatedData['tuesday_close'])->format('H:i'),
            'wednesday_open' => Carbon::createFromFormat('H:i', $validatedData['wednesday_open'])->format('H:i'),
            'wednesday_close' => Carbon::createFromFormat('H:i', $validatedData['wednesday_close'])->format('H:i'),
            'thursday_open' => Carbon::createFromFormat('H:i', $validatedData['thursday_open'])->format('H:i'),
            'thursday_close' => Carbon::createFromFormat('H:i', $validatedData['thursday_close'])->format('H:i'),
            'friday_open' => Carbon::createFromFormat('H:i', $validatedData['friday_open'])->format('H:i'),
            'friday_close' => Carbon::createFromFormat('H:i', $validatedData['friday_close'])->format('H:i'),
            'saturday_closed' => $request->has('saturday_closed') ? 1 : 0,
            'sunday_closed' => $request->has('sunday_closed') ? 1 : 0,
            'monday_closed' => $request->has('monday_closed') ? 1 : 0,
            'tuesday_closed' => $request->has('tuesday_closed') ? 1 : 0,
            'wednesday_closed' => $request->has('wednesday_closed') ? 1 : 0,
            'thursday_closed' => $request->has('thursday_closed') ? 1 : 0,
            'friday_closed' => $request->has('friday_closed') ? 1 : 0,
        ];

        DB::table('branches')->where('id', $id)->update($formattedData);

        return redirect()->back()
            ->with('success', 'Branch updated successfully');
    }

    public function updateBranchLocation(Request $request, $id){

        // if(Auth::user()->id != DB::table('branches')->where('id', $id)->value('user_id'))
        // return;

        $lat = number_format((float)$request->input('lat'), 8, '.', '');
        $lng = number_format((float)$request->input('lng'), 8, '.', '');


        DB::table('branches')
            ->where('id', $id)
            ->update([
                'lat' => $lat,
                'lng' => $lng,
            ]);

        return redirect()->back()->with('success', 'Location successfully changed.');

    }

    public function menu($branchId){

        $user = Auth::user();
//         if($user->id != DB::table('branches')->where('id', $branchId)->value('user_id')){
//             return redirect()->route('restaurant.branches')->with('error', 'Unauthorized access');
//         }

        $categories = Category::
        when($user->isWorker(), function (Builder $query, string $role)use($user, $branchId) {
            if ($branchId) {
                if ($branchId != $user->branch->id) return;
            }

            $query->where('branch_id', $user->branch->id) ->where('user_id', $user->id);
        })
            ->when($user->isRestaurantOwner(), function (Builder $query, string $role)use($user, $branchId) {
                if ($branchId) {
                    $query->where('branch_id', $branchId) ->where('user_id', $user->id);
                }
            })
        ->get();
        if($branchId){
            $branch = Branch::find($branchId);
        }else {
            $branch = Branch::find($user->branch->id);
        }
        return view('restaurant.menu', compact('user', 'categories', 'branch','branchId'));
    }

    public function getCategory(Request $request, $id, $branchId){
        $user = Auth::user();

        if(!$user->isRestaurantOwner()  && $user->branch->id != $branchId){
            return redirect()->route('restaurant.branches')->with('error', 'Unauthorized access');
        }

        $categories = Category::where('branch_id', $branchId)
        ->orderByRaw("id = $id DESC")
        ->get();
        $selectedCategory = $categories->where('id',$id)->first();
        $items = Item::
        where('user_id', $user->id)
        ->where('category_id', $selectedCategory->id)
        ->where('branch_id', $branchId)
        ->orderBy('created_at','DESC')
        ->orderBy('updated_at','DESC')
        ->get();

        return view('restaurant.menu-category', compact('user', 'selectedCategory', 'categories', 'items', 'branchId'));
    }


    public function addCategory(Request $request, $branchId){


        $validator = Validator::make($request->all(), [
            'name_en' => 'required|string',
            'name_ar' => 'required|string',
            'new_category_photo' => 'nullable',
        ]);


        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $userId = Auth::user()?->id;

        $photoFile = $request->file('photo');

        $filename = null;
        if ($photoFile) {
            $filename = Str::random(40) . '.' . $photoFile->getClientOriginalExtension();
            while (Storage::disk('public')->exists('categories/' . $filename)) {
                $filename = Str::random(40) . '.' . $photoFile->getClientOriginalExtension();
            }
            $photoFile->storeAs('categories', $filename, 'public');
        }

        // if($userId != DB::table('branches')->where('id', $branchId)->value('user_id')){
        //     return redirect()->route('restaurant.branches')->with('error', 'Unauthorized access');
        // }

        // if($userId != DB::table('branches')->where('id', $branchId)->value('user_id'))
        //     return;
        Category::create([
            'name' =>trans_json( $request->input('name_en'), $request->input('name_ar')),
            'photo' => $filename ? tenant_asset('categories/'.$filename) : null,
            'user_id' => $userId,
            'branch_id' => $branchId,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->back()->with('success', 'Category successfully added.');
    }

    public function addItem(Request $request, $id, $branchId){

        // if(Auth::user()->id != DB::table('branches')->where('id', $branchId)->value('user_id')){
        //     return redirect()->route('restaurant.branches')->with('error', 'Unauthorized access');
        // }

        // DB::table('categories')->where('id', $id)->where('branch_id', $branchId)->value('user_id') == Auth::user()->id && $request->hasFile('photo')
       // TODO @todo validate the coming request
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
                    'photo' => tenant_asset('items/'.$filename),
                    'price' => $request->input('price'),
                    'calories' => $request->input('calories'),
                    'name' =>trans_json( $request->input('item_name_en'), $request->input('item_name_ar')),
                    'description' =>($request->input('description_en'))?trans_json( $request->input('description_en'), $request->input('description_ar')):null,
                    'checkbox_required' =>( $request->input('checkbox_required'))?array_values( $request->input('checkbox_required')):null,
                    'checkbox_input_titles' =>($request->checkboxInputTitleEn)?array_map(null, $request->checkboxInputTitleEn,  $request->checkboxInputTitleAr):null,
                    'checkbox_input_maximum_choices' => $request->input('checkboxInputMaximumChoice'),
                    'checkbox_input_names' => $this->processOptions($request, 'checkboxInputNameEn', 'checkboxInputNameAr'),
                    'checkbox_input_prices' => $request->input('checkboxInputPrice') ? array_values($request->input('checkboxInputPrice')) : null,
                    'selection_required' => $request->input('selection_required')?array_values( $request->input('selection_required')):null,
                    'selection_input_names' => $this->processOptions($request, 'selectionInputNameEn', 'selectionInputNameAr'),
                    'selection_input_prices' => $request->input('selectionInputPrice') ? array_values($request->input('selectionInputPrice')) : null,
                    'selection_input_titles' =>(isset($request->selectionInputTitleEn))?array_map(null, $request->selectionInputTitleEn,  $request->selectionInputTitleAr):null,
                    'dropdown_required' => ( $request->input('dropdown_required'))?array_values( $request->input('dropdown_required')):null,
                    'dropdown_input_titles' =>(isset($request->dropdownInputTitleEn))?array_map(null, $request->dropdownInputTitleEn,  $request->dropdownInputTitleAr):null,
                    'dropdown_input_names' => $this->processOptions($request, 'dropdownInputNameEn', 'dropdownInputNameAr'),
                    'category_id' => $id,
                    'user_id' => Auth::user()->id,
                    'availability'=>($request->input('availability'))?true:false,
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

    function processOptions($request, $enKey, $arKey) {
        return $request->input($arKey)
            ? array_map(function($en,$ar){
                return array_map(function ($en, $ar) {
                    return [$en, $ar];
                }, $en, $ar);
            }, $request->$enKey, $request->$arKey)
            : null;
    }
    public function deleteCategory($id){
        $user = Auth::user();

        $selectedCategory = DB::table('categories')->where('id', $id)->first();

        if ($selectedCategory && $user->id == $selectedCategory->user_id) {

            DB::table('items')->where('category_id', $id)->delete();
            DB::table('categories')->where('id', $id)->delete();

            return redirect()->route('restaurant.menu', ['branchId' => $selectedCategory->branch_id])->with('success', 'Category successfully deleted.');

        } else {
            return redirect()->back()->with('error', 'You are not authorized to access that page.');
        }
    }

    public function deleteItem($id){

        $user = Auth::user();

        $selectedItem = DB::table('items')->where('id', $id)->first();

        if ($selectedItem && $user->id == $selectedItem->user_id) {

            DB::table('items')->where('id', $id)->delete();

            return redirect()->route('restaurant.menu', ['branchId' => $selectedItem->branch_id])->with('success', 'Item successfully deleted.');

        } else {
            return redirect()->back()->with('error', 'You are not authorized to access that page.');
        }
    }



    public function updateProfile(Request $request)
    {
        $validatedData = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'phone' => 'required|string|max:255',
            // 'commercial_registration' => 'nullable|file',
            // 'delivery_contract' => 'nullable|file',
        ]);

        $loggedUserId = Auth::id();
        $user = RestaurantUser::find($loggedUserId);

        // if ($request->hasFile('commercial_registration')) {
        //     $file = $request->file('commercial_registration');
        //     $contents = file_get_contents($file);
        //     $fileName = Str::random(40) . '.' . $file->getClientOriginalExtension();
        //     $filePath = 'private/commercial_registration/' . $fileName;
        //     Storage::disk('local')->put($filePath, $contents);
        //     $user->commercial_registration_pdf = $fileName;
        // }

        // if ($request->hasFile('delivery_contract')) {
        //     $file = $request->file('delivery_contract');
        //     $contents = file_get_contents($file);
        //     $fileName = Str::random(40) . '.' . $file->getClientOriginalExtension();
        //     $filePath = 'private/delivery_contract/' . $fileName;
        //     Storage::disk('local')->put($filePath, $contents);
        //     $user->signed_contract_delivery_company = $fileName;
        // }

        $user->first_name = $validatedData['first_name'];
        $user->last_name = $validatedData['last_name'];
        // $user->restaurant_name = $validatedData['restaurant_name'];
        $user->phone = $validatedData['phone'];

        // if($user->signed_contract_delivery_company != null && $user->commercial_registration_pdf != null){
        //     $user->isApproved = 0;
        // }
        $user->save();



        return redirect()->back()->with('success', 'Profile updated successfully');
    }

    public function profile(){
        $user = Auth::user();

        return view('restaurant.profile', compact('user'));
    }

    public function workers($branchId){


        $branch = Branch::findOrFail($branchId);
        $user = Auth::user();
        // $workers = User::where('role', 2)->where('restaurant_name', $user->restaurant_name)->where('branch_id', $branchId)
        // ->paginate(15);
        $workers = $branch->workers()
        ->where('id','!=',$user->id)
        ->whereHas('roles', function ($query) {
            $query->where('name', 'Worker');
        })
        ->get();
        return view('restaurant.workers', compact('user', 'workers', 'branchId','branch'));
    }

    public function addWorker($branchId){

        $user = Auth::user();

        return view('restaurant.add-worker', compact('user', 'branchId'));
    }

    public function generateWorker(RegisterWorkerRequest $request, $branchId)
    {

        $input = $request->validated();
        $input['password'] = Hash::make($input['password']);
        $input['phone_verified_at'] = null;
        $input['branch_id']= $branchId;
        $user = RestaurantUser::create($input);

        $user->save();
        $user->assignRole('Worker');
        $permissions = [
            'can_modify_and_see_other_workers',
            'can_modify_working_time',
            'can_modify_advertisements',
            'can_edit_menu',
            'can_control_payment',

        ];

        $insertData = [];

        foreach ($permissions as $permission) {
            $insertData[$permission] = $request->has($permission) ? 1 : 0;
        }

        $insertData['user_id'] = $user->id;

        DB::table('permissions_worker')->insert($insertData);

        if(app()->getLocale() === 'en')
            return redirect()->route("restaurant.workers",$branchId)->with('success', 'Worker added successfully');
        else
            return redirect()->back()->with('success', 'تمت إضافة موظف بنجاح');
    }

    public function deleteWorker($id){
        try {
            DB::beginTransaction();
            DB::table('permissions_worker')->where('user_id', $id)->delete();

            RestaurantUser::findOrFail($id)->delete();

            DB::commit();


            if(app()->getLocale() === 'en')
                return redirect()->back()->with('success', 'Deleted successfully.');
            else
                return redirect()->back()->with('success', 'حذف بنجاح.');
        } catch (\Exception $e) {
            DB::rollBack();

            if(app()->getLocale() === 'en')
                return redirect()->back()->with('error', 'Error deleting user and related records: ' . $e->getMessage());
            else
                return redirect()->back()->with('error', 'خطأ في حذف المستخدم والسجلات ذات الصلة' . $e->getMessage());
        }
    }

    public function updateWorker(Request $request, $id){

        $selectedWorker = RestaurantUser::find($id);

        $selectedWorker->first_name = $request->input('first_name');
        $selectedWorker->last_name = $request->input('last_name');
        $selectedWorker->phone = $request->input('phone');
        $selectedWorker->email = $request->input('email');

        $permissions = [
            'can_modify_and_see_other_workers',
            'can_modify_working_time',
            'can_modify_advertisements',
            'can_edit_menu',
        ];

        $updateData = [];

        foreach ($permissions as $permission) {
            $updateData[$permission] = $request->has($permission) ? 1 : 0;
        }

        DB::table('permissions_worker')
            ->where('user_id', $id)
            ->update($updateData);

        $selectedWorker->save();

        $user = Auth::user();

        if(app()->getLocale() === 'en')
            return redirect()->back()->with([
                'success' => 'Worker updated successfully',
            ])->with(compact('user'));
        else
            return redirect()->back()->with([
                'success' => 'Work updated successfully',
            ])->with(compact('user'));
    }

    public function editWorker($id){

        $user = Auth::user();

        $worker = RestaurantUser::findOrFail($id);

        // if($worker->role != 2){
        //     return abort(404);
        // }
        return view('restaurant.edit-worker', compact('worker', 'user'));
    }
    public function deliveryActivate($module,Request $request){

        $request->validate([
            'api_key'=>"required"
        ]);
        $company = DeliveryCompany::where("module",$module)->first();
        $company->update([
            'status'=>!$company->status,
            'api_key'=>$request->api_key
        ]);
        $message = ($company->status)?__(':module has been successfully activated'):__(':module has been successfully deactivated');
        return redirect()->back()->with([
            'success' => __($message,['module'=>__($module)]),
        ]);

    }
    public function servicesIncrease(){
        Setting::first()->update([
            'branch_slots'=> DB::raw('branch_slots + 1'),
        ]);
        return redirect()->back()->with([
            'success' => __("Branch slot has been increased by one"),
        ]);
    }
}
