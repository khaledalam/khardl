<?php

namespace App\Http\Controllers\Web\Tenant;

use App\Models\Tenant\Item;
use Illuminate\Support\Str;
use App\Models\Subscription;
use App\Models\Tenant\Order;
use Illuminate\Http\Request;
use App\Models\Tenant\Branch;
use App\Models\Tenant\QrCode;
use App\Models\ROSubscription;
use App\Models\Tenant\Setting;
use Illuminate\Support\Carbon;
use App\Models\Tenant\Category;
use Illuminate\Validation\Rule;
use App\Enums\Admin\CouponTypes;
use App\Models\ROCustomerAppSub;
use Illuminate\Support\Facades\DB;
use App\Models\NotificationReceipt;
use App\Models\Tenant\DeliveryType;
use App\Models\ROSubscriptionCoupon;
use App\Models\Tenant\PaymentMethod;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use App\Models\Tenant\RestaurantUser;
use App\Models\Tenant\DeliveryCompany;
use App\Models\Tenant\OrderStatusLogs;
use App\Models\Tenant\RestaurantStyle;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Web\BaseController;
use App\Http\Requests\RegisterWorkerRequest;
use App\Http\Requests\UpdateBranchInfoRequest;
use App\Packages\DeliveryCompanies\Cervo\Cervo;
use App\Packages\DeliveryCompanies\Yeswa\Yeswa;
use Database\Seeders\Tenant\DeliveryTypesSeeder;
use Database\Seeders\Tenant\PaymentMethodSeeder;
use Illuminate\Contracts\Database\Query\Builder;
use App\Models\Subscription as CentralSubscription;
use App\Packages\DeliveryCompanies\DeliveryCompanies;
use App\Packages\DeliveryCompanies\StreetLine\StreetLine;
use App\Http\Services\tenant\Restaurant\RestaurantService;
use App\Http\Requests\Tenant\BranchSettings\UpdateBranchSettingFromRequest;


class RestaurantController extends BaseController
{

    public function promotions()
    {
        $user = Auth::user();
    
        $settings = Setting::all()->firstOrFail();

        $branches = Branch::all()->when($user->isWorker(),function($q)use($user){
            return $q->where('id',$user->branch_id);
        });
        return view(
            'restaurant.promotions',
            compact('user','settings','branches')
        );
    }

    public function updatePromotions(Request $request)
    {
        $request->validate([
            'loyalty_points' => 'required|numeric|min:0',
//            'loyalty_point_price' => 'required|numeric|min:0',
//            'cashback_threshold' => 'required|numeric|min:0',
//            'cashback_percentage' => 'required|numeric|min:0',
        ]);

        $settings = Setting::all()->firstOrFail();

        $settings->loyalty_points = $request->loyalty_points;
//        $settings->loyalty_point_price = $request->loyalty_point_price;
//        $settings->cashback_threshold = $request->cashback_threshold;
//        $settings->cashback_percentage = $request->cashback_percentage;
        $settings->save();

        return redirect()->back()->with('success', __('Restaurant promotions successfully updated.'));
    }

    public function settingsBranch(Branch $branch)
    {
        /** @var RestaurantUser $user */
        $user = Auth::user();
        $payment_methods = $branch->payment_methods->pluck('id', 'name');
        $delivery_types = $branch->delivery_types->pluck('id', 'name');
        $hasActiveDrivers = RestaurantUser::activeDrivers()->get()->count();
        $hasDeliveryCompanies = DeliveryCompanies::all()->count();
        $canPayOnline = Setting::first()?->merchant_id ? 1 : 0 ;
        return view(
            'restaurant.settings_branch',
            compact(
            'user',
            'branch',
            'payment_methods',
            'delivery_types',
            'hasActiveDrivers',
            'hasDeliveryCompanies',
            'canPayOnline',
            'branch'
            )
        );
    }

    public function updateSettingsBranch(UpdateBranchSettingFromRequest $request, Branch $branch)
    {
        $payment_methods = null;
        $delivery_types = null;
        $setting = Setting::first();

        foreach ($request->payment_methods ?? [] as $method) {
            if($method == PaymentMethod::ONLINE && (!$setting->lead_id  || !$setting->merchant_id)){
                return redirect()->back()->with('error', __('You can not activate pay online because payment account not active yet'));
            }
            $payment_methods[] = PaymentMethod::where('name', $method)->first()->id;
        }
        $branch->payment_methods()->sync($payment_methods);

        if($request->filled('pickup_availability')){
            $data['pickup_availability'] = 1;
            $delivery_types[] = DeliveryType::where('name', DeliveryType::PICKUP)->first()->id;
        }else{
            $data['pickup_availability'] = 0;
        }
        if($request->filled('delivery_companies_option') || $request->filled('drivers_option')){
            $delivery_types[] = DeliveryType::where('name', DeliveryType::DELIVERY)->first()->id;
            $data['delivery_companies_option'] = $request->filled('delivery_companies_option') ? 1 : 0;
            $data['drivers_option'] = $request->filled('drivers_option') ? 1 : 0;
        }else{
            $data['delivery_companies_option'] = 0;
            $data['drivers_option'] = 0;
        }
        $branch->update($data);
        $branch->delivery_types()->sync($delivery_types);

        if($request->preparation_time_delivery){
            $branch->update(['preparation_time_delivery' => $request->preparation_time_delivery]);
        }

        $branch->update(['display_category_icon' => $request->has('display_category_icon')]);

        return redirect()->back()->with('success', __('Branch settings successfully updated.'));

    }

    public function branchOrders(Order $order)
    {
        $user = Auth::user();
        if($user->isWorker() && $order->branch_id != $user->branch_id)return abort(403);
        $order->load('user', 'items');
        $orderStatusLogs = OrderStatusLogs::orderBy("created_at",'desc')->where('order_id',$order->id)->get();
        $locale = app()->getLocale();
        return view(
            'restaurant.orders.show',
            compact('user', 'order', 'locale', 'orderStatusLogs')
        );
    }

    public function branches()
    {

        $user = Auth::user();
        $available_branches = $user->number_of_available_branches();
        $branches = Branch::withTrashed()->iSWorker($user)
            ->get()
            ->sortByDesc(['deleted_at']);
        $branch_cost = 0;
        $branch_left = '';
        if($current_sub = ROSubscription::first()){
            $subscription = tenancy()->central(function () {
                return CentralSubscription::first();
            });
            $branch_cost =number_format($current_sub->calculateDaysLeftCost($subscription->amount),2);
            $branch_left = $current_sub->getDateLeftAttribute();

        }

        $weekdays = [];
        for ($i = 0; $i < 7; $i++) {
            $weekdays[] = date('l', strtotime("Sunday +$i days"));
        }

        foreach ($branches as &$branch) {
            $opens = $closes = [];
            $branch['existed_hours_option'] = 'normal';

            foreach ($weekdays as $day) {
                if ($branch->{strtolower($day) . '_closed'}) {
                    $branch['existed_hours_option'] = 'custom';
                    goto out;
                }
                $open = $branch->{strtolower($day) . '_open'};
                $close = $branch->{strtolower($day) . '_close'};

                if (!in_array($open, $opens)) {
                    $opens[] = $open;
                }

                if (!in_array($close, $closes)) {
                    $closes[] = $close;
                }

                if (count($opens) > 1 || count($closes) > 1) {
                    $branch['existed_hours_option'] = 'custom';
                    goto out;
                }
            }
            $branch['existed_normal_from'] = $opens[0];
            $branch['existed_normal_to'] = $closes[0];
            out:
        }

        return view(
            ($user->isRestaurantOwner()) ? 'restaurant.branches' : 'worker.branches',
            compact('available_branches', 'user', 'branches','branch_cost','branch_left')
        ); //view('branches')
    }
    public function toggleBranch($id){
        $branch = Branch::findOrFail($id);
        $branch->update([
            'active'=>!$branch->active
        ]);
        $message = $branch->active ? __("Branch has been activated"):__("Branch has been deactivated");
        return redirect()->back()->with('success',$message);
    }
    public function branches_site_editor()
    {
        $user = Auth::user();

        if (!$user->isRestaurantOwner()) {
            return $this->sendResponse(null, 'Bad request');
        }

        $branches = DB::table('branches')
            ->get(['id', 'is_primary', 'name'])
            ->sortByDesc('is_primary');

        return $this->sendResponse($branches, 'Fetched branches successfully');

    }

    public function addBranch(Request $request)
    {
        if (!$this->can_create_branch()) {
            return redirect()->back()->with('error', 'Not allowed to create branch');
        }

        $daysRules = $weekdays = $formattedData = [];
        for ($i = 0; $i < 7; $i++) {
            $weekdays[] = date('l', strtotime("Sunday +$i days"));
        }

        foreach ($weekdays as $day) {
            $daysRules[strtolower($day) . '_open'] = [Rule::when($request->hours_option == 'custom', 'date_format:H:i')];
            $daysRules[strtolower($day) . '_close'] = [Rule::when($request->hours_option == 'custom', 'date_format:H:i|after:' . strtolower($day) . '_open')];
        }

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string',
            'address' => 'required|string',
            'city' => 'nullable|string',
            'neighborhood' => 'nullable|string',
            'lat-new_branch' => 'required',
            'lng-new_branch' => 'required',
            'copy_menu' => 'required',
            'normal_from' => [Rule::when($request->hours_option == 'normal', 'date_format:H:i')],
            'normal_to' => [Rule::when($request->hours_option == 'normal', 'date_format:H:i|after:normal_from')],
            ...$daysRules
        ], [
            'lat-new_branch.required' => 'Select location',
            'lng-new_branch.required' => 'Select location',
        ]);

        $branchesExist = DB::table('branches')->where('is_primary', 1)->exists();

        $time = function ($time, $open = true) use ($request) {
            if ($request->hours_option == 'normal') {
                if ($open)
                    return Carbon::createFromFormat('H:i', $request->input('normal_from'))->format('H:i');
                else
                    return Carbon::createFromFormat('H:i', $request->input('normal_to'))->format('H:i');
            } else {
                return Carbon::createFromFormat('H:i', $time)->format('H:i');
            }
        };

        $data = [
            'name' => $validatedData['name'],
            'phone' => $validatedData['phone'],
            'address' => $validatedData['address'],
            'city' => $validatedData['city'],
            'neighborhood' => $validatedData['neighborhood'],
            'lat' => (float) $validatedData['lat-new_branch'],
            'lng' => (float) $validatedData['lng-new_branch'],
            'is_primary' => !$branchesExist,
        ];

        foreach ($weekdays as $day) {
            $data[strtolower($day) . '_open'] = $time($validatedData[strtolower($day) . '_open']);
            $data[strtolower($day) . '_close'] = $time($validatedData[strtolower($day) . '_close'], false);
            $data[strtolower($day) . '_closed'] = $request->has(strtolower($day) . '_closed') && $request->hours_option == 'custom' ? 1 : 0;
        }

        $newBranchId = DB::table('branches')->insertGetId($data);

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
                        'photo' => $newFilename,
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
                        'dropdown_input_titles' => $item->dropdown_input_titles,
                        'dropdown_input_names' => $item->dropdown_input_names,
                        'dropdown_input_prices' => $item->dropdown_input_prices,
                        'allow_buy_with_loyalty_points' =>$item->allow_buy_with_loyalty_points,
                        'price_using_loyalty_points' =>$item->price_using_loyalty_points,
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
        $sub = ROSubscription::first();
        $sub->number_of_branches -= 1;
        $sub->save();

        $branch = Branch::where('id', $newBranchId)->first();

        // Set default payment method and delivery type
        $branch->payment_methods()->sync([
            PaymentMethodSeeder::PAYMENT_METHOD_COD,
        ]);
        $branch->delivery_types()->sync([
            DeliveryTypesSeeder::DELIVERY_TYPE_PICKUP
        ]);

        return redirect()->back()->with('success', __('Branch successfully created.'));

    }
    private function can_create_branch()
    {
        // redirect to payment gateway
        $sub = ROSubscription::first();
        if ($sub && $sub->status == 'active') {
            if ($sub->number_of_branches > 0) {
                return true;
            }
        }
        return false;
    }

    private function updateBranchValidation(Request $request)
    {
        $daysRules = $weekdays = [];
        for ($i = 0; $i < 7; $i++) {
            $weekdays[] = date('l', strtotime("Sunday +$i days"));
        }

        $msgs = [];

        foreach ($weekdays as $day) {
            $daysRules[strtolower($day) . '_open'] = [Rule::when($request->existed_hours_option == 'custom', 'date_format:H:i')];
            $daysRules[strtolower($day) . '_close'] = [Rule::when($request->existed_hours_option == 'custom', 'date_format:H:i|after:' . strtolower($day) . '_open')];
            $msgs[strtolower($day) . '_close.after'] = __("Time from should be before to") . ' ' . __('on') . ' ' . __(strtolower($day));
        }

        return $request->validate([
            'existed_normal_from' => [Rule::when($request->existed_hours_option == 'normal', 'date_format:H:i')],
            'existed_normal_to' => [Rule::when($request->existed_hours_option == 'normal', 'date_format:H:i|after:existed_normal_from')],
            ...$daysRules
            ],
            [
                'existed_normal_to.after'=>__("Time from should be before to"),
                ...$msgs
            ]
        );
    }

    public function updateBranch(Request $request, $id)
    {
        $weekdays = $formattedData = [];
        for ($i = 0; $i < 7; $i++) {
            $weekdays[] = date('l', strtotime("Sunday +$i days"));
        }

        $validatedData = $this->updateBranchValidation($request);

        $time = function ($timeInner, $open = true) use ($request) {
            if ($request->existed_hours_option == 'normal') {
                if ($open)
                    return Carbon::createFromFormat('H:i', $request->input('existed_normal_from'))->format('H:i');
                else
                    return Carbon::createFromFormat('H:i', $request->input('existed_normal_to'))->format('H:i');
            } else {
                return Carbon::createFromFormat('H:i', $timeInner)->format('H:i');
            }
        };

        foreach ($weekdays as $day) {
            $formattedData[strtolower($day) . '_open'] = $time($validatedData[strtolower($day) . '_open']);
            $formattedData[strtolower($day) . '_close'] = $time($validatedData[strtolower($day) . '_close'], false);
            $formattedData[strtolower($day) . '_closed'] = $request->has(strtolower($day) . '_closed') && $request->existed_hours_option == 'custom' ? 1 : 0;
        }

        DB::table('branches')->where('id', $id)->update($formattedData);

        return redirect()->back()
            ->with('success', __('Branch updated successfully'));
    }

    public function updateBranchDetails(UpdateBranchInfoRequest $request, $id)
    {
        $branch = Branch::findOrFail($id);

        $branch->name = $request->name;
        $branch->phone = $request->phone;
        $branch->city = $request->city;
        $branch->neighborhood = $request->neighborhood;

        $branch->save();

        return redirect()->back()
            ->with('success', __('Branch updated successfully'));
    }


    public function updateBranchLocation(Request $request, $id)
    {

        // if(Auth::user()->id != DB::table('branches')->where('id', $id)->value('user_id'))
        // return;

        $lat = number_format((float) $request->input('lat'), 8, '.', '');
        $lng = number_format((float) $request->input('lng'), 8, '.', '');
        $address = $request->input('location');


        DB::table('branches')
            ->where('id', $id)
            ->update([
                'lat' => $lat,
                'lng' => $lng,
                'address' => $address
            ]);

        return redirect()->back()->with('success', __('Location successfully changed.'));

    }

//    public function menu($branchId)
//    {
//
//        $user = Auth::user();
//        //         if($user->id != DB::table('branches')->where('id', $branchId)->value('user_id')){
////             return redirect()->route('restaurant.branches')->with('error', 'Unauthorized access');
////         }
//
//        $categories = [];
//        if ($user->isWorker()) {
//            $categories = Category::
//                when($user->isWorker(), function (Builder $query, string $role) use ($user, $branchId) {
//                    if ($branchId) {
//                        if ($branchId != $user->branch->id)
//                            return;
//                    }
//
//                    $query->where('branch_id', $user->branch->id)->where('user_id', $user->id);
//                })
//                ->get()
//                ->sortBy('sort');
//        } else if($user->isRestaurantOwner()) {
//            $categories = Category::where('branch_id', $branchId ?? $user->branch->id)
//                ->get()
//                ->sortBy('sort');
//        }
//
//        if ($branchId) {
//            $branch = Branch::find($branchId);
//        } else {
//            $branch = Branch::find($user->branch->id);
//        }
//        $branches = Branch::all();
//
//        return view('restaurant.menu', compact('user', 'categories', 'branch', 'branchId','branches'));
//    }

    public function noBranches()
    {
        $user = Auth::user();
        return view('restaurant.no_branches', compact('user'));
    }

    public function getCategory(Request $request, $id, $branchId)
    {
        $user = Auth::user();

        if (!$user->isRestaurantOwner() && $user->branch->id != $branchId) {
            return redirect()->route('restaurant.branches')->with('error', __('Unauthorized'));
        }

        $categories = Category::where('branch_id', $branchId)
//            ->orderByRaw("id = $id DESC")
            ->get();

        $selectedCategory = Category::where('id',$id)->first();
        $items = Item::
            when($user->isWorker(), function (Builder $query, string $role) use ($user, $branchId) {
                if ($branchId) {
                    if ($branchId != $user->branch->id)
                        return;
                }

                $query->where('branch_id', $user->branch->id);
            })
            ->where('category_id', $selectedCategory?->id)
            ->where('branch_id', $branchId)
            ->orderBy('created_at', 'DESC')
            ->orderBy('updated_at', 'DESC')
            ->orderByRaw('availability DESC')
            ->get();

        $branches = Branch::all();

        return view('restaurant.menu-category', compact('branches', 'user', 'selectedCategory', 'categories', 'items', 'branchId'));
    }

    public function editCategory(Request $request, $categoryId, $branchId)
    {
        $categoriesCount = Category::where([
                ['branch_id', '=', $branchId]
        ])->count();

        $validator = Validator::make($request->all(), [
            'name_en' => 'required|string|max:100|min:2',
            'name_ar' => 'required|string|max:100|min:2',
            'photo' => 'nullable|mimes:png,jpg,jpeg,gif|max:4096',
            'sort' => 'nullable|int|min:1|max:' . $categoriesCount
        ]);
        if ($validator->fails()) {
            return redirect()->back()->with('error', $validator->errors());
        }

        $category = Category::findOrFail($categoryId);

        $category->update([
            'name' => [
                'ar' => $request->name_ar,
                'en' => $request->name_en,
            ],

        ]);
        $category->update(['sort' => $request->sort]);

        $photoFile = $request->file('photo');
        $filename = null;
        if ($photoFile) {
            $filename = Str::random(40) . '.' . $photoFile->getClientOriginalExtension();
            while (Storage::disk('public')->exists('categories/' . $filename)) {
                $filename = Str::random(40) . '.' . $photoFile->getClientOriginalExtension();
            }
            $photoFile->storeAs('categories', $filename, 'public');
            $category->update(['photo' => 'categories/' . $filename]);
        }

        return redirect()->back()->with('success', __('Updated successfully'));
    }
    public function addCategory(Request $request, $branchId)
    {
        $categoriesCountAll = Category::where([
            ['branch_id', '=', $branchId],
        ])->count();

        $validator = Validator::make($request->all(), [
            'name_en' => 'required|string',
            'name_ar' => 'required|regex:/^[0-9\p{Arabic}\s]+$/u',
            'new_category_photo' => 'nullable',
            'sort' => 'nullable|int|min:1|max:' . $categoriesCountAll + 1
        ], [
            'name_ar.regex' => __("Arabic name is not valid"),
            'name_ar.required' => __('Arabic name is required'),
            'name_en.required' => __('English name is required')
        ]);


        if ($validator->fails()) {
            return redirect()->back()->with('error', $validator->errors()->first());
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
            'name' => trans_json($request->input('name_en'), $request->input('name_ar')),
            'photo' => $filename ? 'categories/' . $filename : null,
            'sort' =>  $categoriesCountAll + 1,
            'user_id' => $userId,
            'branch_id' => $branchId,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->back()->with('success', __('Created successfully'));
    }

    public function deleteCategory($id)
    {
        $user = Auth::user();

        $selectedCategory = DB::table('categories')->where('id', $id)->first();

        if ($user->isRestaurantOwner() || ($selectedCategory && $user->id == $selectedCategory->user_id)) {

            $branch_id = DB::table('items')->where('category_id', $id)->first()?->branch_id;

            DB::table('items')->where('category_id', $id)->delete();
            DB::table('categories')->where('id', $id)->delete();

            $otherCategories = DB::table('categories')
                ->where('id', '!=', $id)
                ->where('branch_id', '=', $branch_id)
                ->orderBy('sort')
                ->get()->all();

            $idx = 1;
            foreach($otherCategories as $otherCategory) {
                $category = Category::findOrFail($otherCategory?->id);
                $category->update([
                    'sort' => $idx++,
                    'branch_id' => $category->branch_id
                ]);
            }

            return redirect()->route('restaurant.get-category', ['id' => Category::where('branch_id', $selectedCategory->branch_id)?->first()?->id ?? -1, 'branchId' => $selectedCategory->branch_id])->with('success', 'Category successfully deleted.');

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

    public function profile()
    {
        $user = Auth::user();

        return view('restaurant.profile', compact('user'));
    }
    public function toggleLoyaltyPoint($id){
        $user = Auth::user();
        $branch = Branch::findOrFail($id);
        if($user->isWorker() && $id != $user->branch->id)  return null;
        $branch->loyalty_availability = !$branch->loyalty_availability;
        $branch->save();
        return response()->json(['checked' => $branch->loyalty_availability]);


    }
}
