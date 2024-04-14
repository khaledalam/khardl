<?php

namespace App\Http\Controllers\Web\Tenant;

use App\Http\Requests\Tenant\BranchSettings\UpdateBranchSettingFromRequest;
use App\Models\Tenant\Item;
use App\Models\Tenant\QrCode;
use App\Models\Tenant\RestaurantStyle;
use App\Packages\DeliveryCompanies\DeliveryCompanies;
use Database\Seeders\Tenant\DeliveryTypesSeeder;
use Database\Seeders\Tenant\PaymentMethodSeeder;
use Illuminate\Support\Facades\Http;
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
use App\Models\ROCustomerAppSub;
use App\Models\ROSubscription;
use App\Models\Tenant\DeliveryCompany;
use App\Packages\DeliveryCompanies\Cervo\Cervo;
use App\Packages\DeliveryCompanies\StreetLine\StreetLine;


class RestaurantController extends BaseController
{
    public function __construct(
        private RestaurantService $restaurantService
    ) {
    }
    public function index()
    {
        return $this->restaurantService->index();
    }

    public function services()
    {
        /** @var RestaurantUser $user */
        $user = Auth::user();

        $subscription = tenancy()->central(function () {
            return Subscription::first();
        });
        $RO_subscription = ROSubscription::first();
        $customer_tap_id = Auth::user()->tap_customer_id;
        $setting  = Setting::first();

        $active_branches = Branch::where('active',true)->count();
        $total_branches = $active_branches + ( $RO_subscription->number_of_branches ?? 0);
        $amount = $total_branches * $subscription->amount;
        $non_active_branches = Branch::where('active',false)->count();
        if($RO_subscription && $RO_subscription->status  == ROSubscription::SUSPEND && $active_branches == 0 && $RO_subscription->number_of_branches == 0){
            $amount =  $subscription->amount;
            $total_branches = 1;
        }
        return view('restaurant.service', compact('user','active_branches','RO_subscription','non_active_branches','customer_tap_id','subscription','setting','amount','total_branches'));
    }
    public function appServices(){
        /** @var RestaurantUser $user */
        $user = Auth::user();

        $customer_app_sub = tenancy()->central(function () {
            return  Subscription::skip(1)->first();
        });
        $ROCustomerAppSub = ROCustomerAppSub::first();
        $customer_tap_id = Auth::user()->tap_customer_id;

        return view('restaurant.service-app', compact('user','customer_app_sub','ROCustomerAppSub','customer_tap_id'));
    }
    public function serviceDeactivate()
    {
        /** @var RestaurantUser $user */
        ROSubscription::first()->update([
            'status' => ROSubscription::DEACTIVATE
        ]);
        return redirect()->back()->with('success', __('Branches has been deactivated successfully'));
    }
    public function serviceActivate()
    {
        /** @var RestaurantUser $user */
        $subscription = ROSubscription::first();
        if ($subscription->status != ROSubscription::DEACTIVATE) {
            return redirect()->back()->with('error', __('not allowed'));
        }
        ROSubscription::first()->update([
            'status' => ROSubscription::ACTIVE
        ]);
        return redirect()->back()->with('success', __('Branches has been activated successfully'));
    }
    public function serviceCalculate($type, $number_of_branches,$subscription_id)
    {
        return ROSubscription::serviceCalculate($type, $number_of_branches,$subscription_id,true);
    }
    public function delivery(Request $request)
    {
        /** @var RestaurantUser $user */
        $user = Auth::user();
        $modules = [
            class_basename(Yeswa::class),
            class_basename(Cervo::class),
            class_basename(StreetLine::class),
        ];

        $deliveryCompanies = DeliveryCompany::whereIn('module', $modules)
        ->whenModule($request['area'] ?? null);
        $yeswa = clone $deliveryCompanies;
        $yeswa = $yeswa->where('module', 'Yeswa')->first();
        $cervo = clone $deliveryCompanies;
        $cervo = $cervo->where('module', 'Cervo')->first();
        $streetline = clone $deliveryCompanies;
        $streetline = $streetline->where('module', 'StreetLine')->first();
        $allCities = $deliveryCompanies->pluck('coverage_area')->flatten()->unique();
        return view(
            'restaurant.delivery_companies.companies',
            compact('user', 'streetline', 'yeswa', 'cervo', 'allCities')
        );
    }

    /* public function promotions()
    {
        $user = Auth::user();

        $settings = Setting::all()->firstOrFail();

        return view(
            'restaurant.promotions',
            compact('user', 'settings')
        );
    } */

    public function updatePromotions(Request $request)
    {

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
        $hasActiveDrivers = RestaurantUser::activeDrivers()->get()->count();
        $hasDeliveryCompanies = DeliveryCompanies::all()->count();
        $branch->update([
            'delivery_availability'=>false,
            'pickup_availability'=>false
        ]);
        foreach ($request->delivery_types ?? [] as $method) {
            if($method == DeliveryType::DELIVERY && !$hasActiveDrivers  && !$hasDeliveryCompanies){
                return redirect()->back()->with('error', __('you are not signed with any delivery company as well as no active drivers'));
            }
            if($method == DeliveryType::DELIVERY && ($hasActiveDrivers  || $hasDeliveryCompanies)){
                $branch->update([
                    'delivery_availability'=>true
                ]);
            }

            if($method == DeliveryType::PICKUP){
                $branch->update([
                    'pickup_availability'=>true
                ]);
            }
            $delivery_types[] = DeliveryType::where('name', $method)->first()->id;
        }
        $branch->payment_methods()->sync($payment_methods);
        $branch->delivery_types()->sync($delivery_types);
        if($request->preparation_time_delivery){
            $branch->update(['preparation_time_delivery' => $request->preparation_time_delivery]);
        }

        $branch->update(['display_category_icon' => $request->has('display_category_icon')]);

        return redirect()->back()->with('success', __('Branch settings successfully updated.'));

    }


    public function orders_all()
    {
        /** @var RestaurantUser $user */
        $user = Auth::user();
        $orders = Order::orderBy('created_at', 'DESC')->paginate(10);
        return view(
            'restaurant.orders_all',
            compact('user', 'orders')
        );
    }

    public function orders_add()
    {
        /** @var RestaurantUser $user */
        $user = Auth::user();

        return view(
            'restaurant.orders_add',
            compact('user')
        );
    }

    public function branchOrders(Order $order)
    {

        $user = Auth::user();
        $order->load('user', 'items');

        $orderStatusLogs = OrderStatusLogs::all()->sortByDesc("created_at");
        $locale = app()->getLocale();
        return view(
            'restaurant.orders.show',
            compact('user', 'order', 'locale', 'orderStatusLogs')
        );
    }


    private function qrCanAccess()
    {
        return Setting::first()?->is_live && ROSubscription::first()?->status == ROSubscription::ACTIVE;
    }

    public function qr()
    {
        if (!$this->qrCanAccess()) {
            return redirect()->route('restaurant.summary')->with('error', __('You are not allowed to access this page'));
        }

        /** @var RestaurantUser $user */
        $user = Auth::user();
        $qrcodes = QrCode::orderBy('id', 'desc')->paginate(10);

        return view(
            'restaurant.qr',
            compact('user', 'qrcodes')
        );
    }


    public function qrCreate(Request $request){

        if (!$this->qrCanAccess()) {
            return redirect()->route('restaurant.summary')->with('error', __('You are not allowed to access this page'));
        }

        $imageUrl = "";
        if (file_exists($request->file("file"))) {
            $response = Http::withHeaders([
                "X-RapidAPI-Host" => "qrcode-monkey.p.rapidapi.com",
                "X-RapidAPI-Key" => "f72e221083msh5ff50679b312fbap131e53jsna069e8de315b",
            ])->attach('file', $request->file('file')->getPathname(), $request->file('file')->getClientOriginalName())
                ->post("https://qrcode-monkey.p.rapidapi.com/qr/uploadImage");


            if ($response->successful()) {

                $uploadedFile = $request->file('file'); //Instead of before taking $response->json and taking the "file" name from the response, I now tried uploading image to the server and getting logo made by inputing URL not fileName I get from this api


//                $imagePath = uniqid('', false) . '.' . $uploadedFile->getClientOriginalExtension();
//                Storage::disk('qrcodes')->put($imagePath, file_get_contents($uploadedFile));

                $imageUrl = tenant_asset(store_image($uploadedFile, QrCode::STORAGE, uniqid('', true)));
            } else {
                return "cURL Error 1 #: " . $response->status();
            }
        }


        $gradientColor1 = "";
        $gradientColor2 = "";

        if($request->input('single_color') == 0){
            $gradientColor1 = $request->input('bodyColor');
            $gradientColor2 = $request->input('gradientColor2');
        }

        $logoMode = "default";

        if($request->input("logoMode") == 1){
            $logoMode = "clean";
        }

        $gradientOnEyes = $request->input('single_color') == 0 ? true : false;

        $response = Http::withHeaders([
            "X-RapidAPI-Host" => "qrcode-monkey.p.rapidapi.com",
            "X-RapidAPI-Key" => "f72e221083msh5ff50679b312fbap131e53jsna069e8de315b",
        ])->post('https://qrcode-monkey.p.rapidapi.com/qr/custom', [
            "data" => $request->input('data'),
            "config" => [
                'body' => $request->input('body'),
                'eye' => $request->input('eye'),
                'eyeBall' => $request->input('eyeBall'),
                "erf1" => [],
                "erf2" => ['fh'],
                "erf3" => ['fv'],
                "brf1" => [],
                "brf2" => ['fh'],
                "brf3" => ['fv'],
                'bodyColor' => $request->input("bodyColor"),
                "bgColor" => $request->input("bgColor"),
                "eye1Color" => $request->input('eyeColor'),
                "eye2Color" => $request->input('eyeColor'),
                "eye3Color" => $request->input('eyeColor'),
                "eyeBall1Color" => $request->input('eyeBallColor'),
                "eyeBall2Color" => $request->input('eyeBallColor'),
                "eyeBall3Color" => $request->input('eyeBallColor'),
                "gradientColor1" => $gradientColor1,
                "gradientColor2" => $gradientColor2,
                "gradientType" => "linear",
                "gradientOnEyes" => $gradientOnEyes,
                //Putting an actual link to a working picture as test to see does it work on a picture that is accessible, so its not my local host
                "logo" => $imageUrl, // 'https://www.fnordware.com/superpng/pnggrad16rgb.png',
                "logoMode" => $logoMode
            ],
            "size" => $request->input('size'),
            "download" => "true",
            "file" => "png"
        ]);


        if ($response->successful()) {
            $imageContent = $response->body();

            // short uuid
//            $imageUrl = tenant_asset(store_image($uploadedFile, QrCode::STORAGE, uniqid('', false)));

            $imageName = uniqid('', false) . '.png';
            Storage::disk(QrCode::STORAGE)->put($imageName, $imageContent);

            $qrCode = QrCode::create([
                'image_path' => $imageName,
                'url' => $request->input('data'),
                'name' => $request->input('name'),
            ]);

            return redirect()->route("restaurant.qr")
                ->with('success',__('QR Code has been created successfully'));
        }

        return "cURL Error 2 #: " . $response->status();
    }

    public function downloadQrCode($id)
    {
        if (!$this->qrCanAccess()) {
            return redirect()->route('restaurant.summary')->with('error', __('You are not allowed to access this page'));
        }

        $qr = QrCode::findOrFail($id);
        $fileName = $qr->image_path;

        if (!Storage::disk(QrCode::STORAGE)->exists($fileName)) {
            abort(404);
        }

        $fileContents = Storage::disk(QrCode::STORAGE)->get($fileName);

        return response($fileContents)
            ->header('Content-Type', 'image/png')
            ->header('Content-Disposition', 'attachment; filename="' . $fileName . '"');

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
                return Subscription::first();
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
            'lat-new_branch' => 'required',
            'lng-new_branch' => 'required',
            'copy_menu' => 'required',
            'normal_from' => [Rule::when($request->hours_option == 'normal', 'date_format:H:i')],
            'normal_to' => [Rule::when($request->hours_option == 'normal', 'date_format:H:i|after:normal_from')],
            ...$daysRules
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
                        'dropdown_input_titles' => $item->dropdown_input_titles,
                        'dropdown_input_names' => $item->dropdown_input_names,
                        'dropdown_input_prices' => $item->dropdown_input_prices,
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

        return redirect()->back()->with('success', __('Branch successfully created'));

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
            ->with('success', 'Branch updated successfully');
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

        return redirect()->back()->with('success', 'Location successfully changed.');

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
            return redirect()->route('restaurant.branches')->with('error', 'Unauthorized access');
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

                $query->where('branch_id', $user->branch->id)->where('user_id', $user->id);
            })
            ->where('category_id', $selectedCategory?->id)
            ->where('branch_id', $branchId)
            ->orderBy('created_at', 'DESC')
            ->orderBy('updated_at', 'DESC')
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
            $category->update(['photo' => tenant_asset('categories/' . $filename)]);
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
            'name_ar' => 'required|string',
            'new_category_photo' => 'nullable',
            'sort' => 'nullable|int|min:1|max:' . $categoriesCountAll + 1
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
            'name' => trans_json($request->input('name_en'), $request->input('name_ar')),
            'photo' => $filename ? tenant_asset('categories/' . $filename) : null,
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

        if ($selectedCategory && $user->id == $selectedCategory->user_id) {

            DB::table('items')->where('category_id', $id)->delete();
            DB::table('categories')->where('id', $id)->delete();

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

    public function workers($branchId)
    {

        $branch = Branch::findOrFail($branchId);
        $user = Auth::user();
        // $workers = User::where('role', 2)->where('restaurant_name', $user->restaurant_name)->where('branch_id', $branchId)
        // ->paginate(15);
        $workers = $branch->workers()
//            ->where('id', '!=', $user->id)
            ->whereHas('roles', function ($query) {
                $query->where('name', 'Worker');
            })
            ->orderBy('id','asc')
            ->get();
        return view('restaurant.workers', compact('user', 'workers', 'branchId', 'branch'));
    }

    public function addWorker($branchId)
    {

        $user = Auth::user();

        return view('restaurant.add-worker', compact('user', 'branchId'));
    }

    public function generateWorker(RegisterWorkerRequest $request, $branchId)
    {

        $input = $request->validated();
        $input['password'] = Hash::make($input['password']);
        $input['phone_verified_at'] = null;
        $input['branch_id'] = $branchId;
        $user = RestaurantUser::create($input);

        $user->save();
        $user->assignRole('Worker');
        $permissions = [
            'can_modify_and_see_other_workers',
            'can_modify_working_time',
            'can_edit_menu',
            'can_control_payment',
            'can_view_revenues'
        ];
        $insertData = [];

        foreach ($permissions as $permission) {
            $insertData[$permission] = $request->has($permission) ? 1 : 0;
        }

        $insertData['user_id'] = $user->id;

        DB::table('permissions_worker')->insert($insertData);

        return redirect()->route('restaurant.workers',['branchId' => $user->branch_id])->with([
            'success' => __('Added successfully'),
        ]);
    }

    public function deleteWorker($id)
    {
        try {
            DB::beginTransaction();
            DB::table('permissions_worker')->where('user_id', $id)->delete();

            $user = RestaurantUser::findOrFail($id);
            $branch = $user->branch_id;
            $user->delete();

            DB::commit();


            return redirect()->route('restaurant.workers',['branchId' => $branch])->with([
                'success' => __('Deleted successfully'),
            ]);
        } catch (\Exception $e) {
            DB::rollBack();

            if (app()->getLocale() === 'en')
                return redirect()->back()->with('error', 'Error deleting user and related records: ' . $e->getMessage());
            else
                return redirect()->back()->with('error', 'خطأ في حذف المستخدم والسجلات ذات الصلة' . $e->getMessage());
        }
    }

    public function updateWorker(Request $request, $id)
    {
        $selectedWorker = RestaurantUser::find($id);

        $user = Auth::user();
        if ($user?->id == $selectedWorker?->id) {
            return redirect()->back()->with('error', __('not allowed'));
        }

        $selectedWorker->first_name = $request->input('first_name');
        $selectedWorker->last_name = $request->input('last_name');
        $selectedWorker->phone = $request->input('phone');
        $selectedWorker->email = $request->input('email');

        if($request->has('password') && $user?->hasPermissionWorker('can_modify_and_see_other_workers')
            && $request->password && strlen($request->password) >= 6) {
            $selectedWorker->password = Hash::make($request->password);
        }

        $permissions = [
            'can_modify_and_see_other_workers',
            'can_modify_working_time',
            'can_edit_menu',
            'can_control_payment',
            'can_view_revenues'
        ];

        $updateData = [];

        foreach ($permissions as $permission) {
            $updateData[$permission] = $request->has($permission) ? 1 : 0;
        }

        DB::table('permissions_worker')
            ->where('user_id', $id)
            ->update($updateData);

        $selectedWorker->save();
        return redirect()->route('restaurant.workers',['branchId' => $selectedWorker->branch_id])->with([
            'success' => __('Updated successfully'),
        ]);
    }

    public function editWorker($id)
    {
        $user = Auth::user();

        $worker = RestaurantUser::findOrFail($id);

        if ($user?->id == $worker?->id) {
            return redirect()->back()->with('error', __('not allowed'));
        }

        // if($worker->role != 2){
        //     return abort(404);
        // }
        return view('restaurant.edit-worker', compact('worker', 'user'));
    }
    public function deliveryActivate($module, Request $request)
    {

        $request->validate([
            'api_key' => "required"
        ]);
        $company = DeliveryCompany::where("module", $module)->first();
        if ($company->status == false) {
            if (!$company->module->verifyApiKey($request->api_key)) {
                return redirect()->back()->with([
                    'error' => __("Api Key not correct, please contact :module support team to ensure about it", ['module' => $module]),
                ]);
            }
        }

        $company->update([
            'status' => !$company->status,
            'api_key' => $request->api_key
        ]);
        $message = ($company->status) ? __(':module has been successfully activated') : __(':module has been successfully deactivated');
        return redirect()->back()->with([
            'success' => __($message, ['module' => __($module)]),
        ]);

    }

}
