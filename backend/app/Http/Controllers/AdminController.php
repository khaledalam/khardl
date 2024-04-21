<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Log;
use App\Models\User;
use App\Models\Tenant;
use App\Models\Promoter;
use App\Mail\DeniedEmail;
use App\Mail\ApprovedEmail;
use Illuminate\Support\Str;
use App\Models\Subscription;
use Illuminate\Http\Request;
use App\Enums\Admin\LogTypes;
use App\Models\CentralSetting;
use App\Jobs\SendDeniedEmailJob;
use App\Mail\ApprovedRestaurant;
use App\Jobs\SendApprovedEmailJob;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Models\Tenant\RestaurantUser;
use App\Models\Tenant\OrderStatusLogs;
use Illuminate\Contracts\Mail\Mailable;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;
use Spatie\Permission\Models\Permission;
use App\Jobs\SendApprovedRestaurantEmailJob;
use App\Http\Requests\AddSubDiscountFormRequest;
use App\Models\Tenant\Setting as TenantSettings;
use App\Http\Requests\Central\Promoter\AddPromoterFormRequest;
use App\Models\ROSubscriptionCoupon;

class AdminController extends Controller
{

    public function addUser()
    {
        $user = Auth::user();

        return view('admin.add-user', compact('user'));
    }

    public function promoters(){

        $promoters = Promoter::orderBy('id','desc')
        ->paginate(config('application.perPage') ?? 15);

        $user = Auth::user();
        return view('admin.promoters', compact('user', 'promoters'));
    }
    public function promotersSub(){
        $promoters = Promoter::orderBy('id','desc')->get();
        $coupons = ROSubscriptionCoupon::orderBy('id','desc')
        ->paginate(config('application.perPage') ?? 15);
        $user = Auth::user();
        return view('admin.promoters_sub', compact('user','coupons', 'promoters'));
    }
    public function savePromotersSub(AddSubDiscountFormRequest $request){

        ROSubscriptionCoupon::create([
            'code'=> $request->code,
            'amount'=> $request->type == 'fixed' ? $request->fixed:$request->percentage,
            'is_branch_purchase'=>  $request->is_branch_purchase ?? false,
            'is_application_purchase'=>  $request->is_application_purchase ?? false,
            'type'=>  $request->type,
            'max_use'=> $request->max_use ?? null ,
            'promoter_id'=> $request->promoter_id ,
        ]);
        return redirect()->back()->with(['success' => __('Created successfully')]);

    }
    public function addPromoter(AddPromoterFormRequest $request){

        $name = $request['name'];
        $url = $request['url'];
        if(is_null($url)){
            $newURL = Str::random(16);
            while (DB::table('promoters')->where('url', $newURL)->exists()) {
                $newURL = Str::random(16);
            }
            $url = $newURL;
        }

        $insertData = [];
        $insertData['url'] = $url;
        $insertData['name'] = $name;
        $insertData['user_id'] = Auth::user()->id;

        $promoter = Promoter::create($insertData);
        $actions = [
            'en' => 'Create a promoter called: ' . $promoter->name,
            'ar' => 'انشأ مروج باسم : ' . $promoter->name,
        ];
        Log::create([
            'user_id' => Auth::id(),
            'action' => $actions,
            'type' => LogTypes::CreatePromoter
        ]);
        return redirect()->back()->with('success', __('Added successfully'));
    }

    public function generateUser(Request $request)
    {

        $existingUser = User::where('email', $request['email'])->first();
        if ($existingUser) {
            if(app()->getLocale() === 'en')
                return redirect()->back()->with('error', 'Email is already registered.');
            else
                return redirect()->back()->with('error', 'عنوان البريد الإلكترونى هذا مسجل بالفعل');

        }

        $user = new User();
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->position =$request->position;
        $user->phone = $request->phone;
        $user->email_verified_at = now();
        $user->save();
        $user->assignRole('Administrator');

        $permissions = [
            'can_access_restaurants',
            'can_view_restaurants',
            'can_approve_restaurants',
            'can_see_admins',
            'can_edit_admins',
            'can_add_admins',
            'can_promoters',
            'can_see_logs',
            'can_settings',
            'can_edit_profile',
            'can_delete_restaurants',
            'can_see_restaurant_owners',
            'can_manage_notifications_receipt'
        ];

        $insertData = [];

        foreach ($permissions as $permission) {
            $insertData[$permission] = $request->has($permission) ? 1 : 0;
        }

        $insertData['user_id'] = $user->id;
        $insertData['can_access_dashboard'] = 1;

        DB::table('permissions')->insert($insertData);
        $actions = [
            'en' => 'Create user with email : ' . $user->email,
            'ar' => 'انشأ مستتخدم ببريد : ' . $user->email,
        ];
        Log::create([
            'user_id' => Auth::id(),
            'action' => $actions,
            'type'  => LogTypes::CreateUser
        ]);

        if(app()->getLocale() === 'en')
            return redirect()->route('admin.user-management')->with('success', 'Admin added successfully');
        else
            return redirect()->route('admin.user-management')->with('success', 'تمت إضافة المسؤول بنجاح');
    }

    public function profile()
    {
        $user = Auth::user();
        return view('admin.profile', compact('user'));
    }

    public function editProfile(){

        $user = Auth::user();
        return view('admin.edit-profile', compact('user'));
    }

    public function updateProfile(Request $request){
        $loggedUserId = Auth::id();
        $validatedData = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,'.$loggedUserId,
            'phone' => 'required|string|max:255',
        ]);


        $user = User::find($loggedUserId);
        $actions = [
            'en' => 'Has edited his profile',
            'ar' => 'تم تعديل ملفه الشخصي',
        ];
        Log::create([
            'user_id' => Auth::id(),
            'action' => $actions,
            'type' =>  LogTypes::UpdateProfile
        ]);

        $user->first_name = $validatedData['first_name'];
        $user->last_name = $validatedData['last_name'];
        $user->email = $validatedData['email'];
        $user->phone = $validatedData['phone'];
        if($request->input('password') != ""){
            $user->password = Hash::make($request->input('password'));
        }

        $user->save();

        if(app()->getLocale() === 'en')
            return redirect()->route('admin.profile')->with('success', 'Profile updated successfully');
        else
            return redirect()->route('admin.profile')->with('success', 'تم تحديث الملف الشخصي بنجاح');

    }

    public function restaurants(Request $request)
    {

        $query =  Tenant::query()->with('primary_domain');
        $restaurants = $query->get();
        if ($request->has('search')) {
            $search = $request->input('search');


            $query->Where('restaurant_name','like', '%' . $search . '%');
            $query->whereHas('primary_domain', static function($query1) use ($search) {
                $query1->OrWhere('domain', 'like', '%' . $search . '%');
            });
        }
        if ($request->has('status') && $request->input('status') !== "all") {
            $status = $request->input('status');
            foreach($restaurants as $restaurant){
                    $status = $request->input('status');
                    if($status == 'live'){
                        if($restaurant->is_live()){
                            $query->where('id', $restaurant->id);
                        }else {
                            $query->where('id','!=', $restaurant->id);
                        }
                    }else {
                        if($restaurant->is_live()){
                            $query->where('id','!=', $restaurant->id);
                        }else {
                            $query->where('id', $restaurant->id);
                        }
                    }

            }
        }


        $restaurants = $query->paginate();
        $user = Auth::user();

        return view('admin.restaraunts', compact('restaurants', 'user'));
    }


    public function activateRestaurant(Tenant $restaurant){

        $error = false;
        $restaurant->run(static function() use (&$error){
            if (TenantSettings::first()->is_live) {
                $error = true;
            } else {
                TenantSettings::first()->update(['is_live' => true]);
            }
        });

        if ($error) {
            return redirect()->back()->with('error', 'Restaurant is already approved');
        }

        $user = User::find($restaurant->user_id);

        $user->status = User::STATUS_ACTIVE;
        $user->reject_reasons = null;
        $user->save();

        $restaurant->run(function () use($user){
            $rUser = RestaurantUser::where('email', '=', $user?->email)->first();
            $rUser->status = RestaurantUser::ACTIVE;
            $rUser->reject_reasons = null;
            $rUser->save();
        });

        SendApprovedRestaurantEmailJob::dispatch($restaurant);

        $actions = [
            'en' => 'Has activate restaurant with an name of: ' . "<a href=".route('admin.view-restaurants',['tenant'=>$restaurant->id])."> $restaurant->restaurant_name </a>",
            'ar' => 'تم تفعيل المطعم بإسم: ' . "<a href=".route('admin.view-restaurants',['tenant'=>$restaurant->id])."> $restaurant->restaurant_name </a>",
        ];
        Log::create([
            'user_id' => Auth::id(),
            'action' => $actions,
            'type'  =>  LogTypes::ActivateRestaurant
        ]);

        return redirect()->route('admin.view-restaurants',['tenant'=>$restaurant->id])->with('success', __("Restaurant has been activated successfully."));

    }





    public function deleteRestaurant($id)
    {
        //
        User::findOrFail($id)->delete();
        $actions = [
            'en' => 'Has deleted a restaurant with an ID of: ' . $id,
            'ar' => 'حذف مطعم بمعرف: ' . $id,
        ];
        Log::create([
            'user_id' => Auth::id(),
            'action' => $actions,
            'type' => LogTypes::DeleteRestaurant
        ]);

        if(app()->getLocale() === 'en')
            return redirect()->back()->with('success', 'Deleted successfully.');
        else
            return redirect()->back()->with('success', 'حذف بنجاح.');
    }

    public function deleteUser($id)
    {
        $user = User::whereHas('roles',function($q){
            return $q->where("name","Administrator");
        })
        ->where("id",'!=',Auth::id())
        ->findOrFail($id);

        DB::beginTransaction();

        try {
            $actions = [
                'en' => 'Has deleted an user with id: ' . $user->id,
                'ar' => 'حذف مستخدم بمعرف:  ' . $user->id,
            ];
            Log::create([
                'user_id' => Auth::id(),
                'action' => $actions,
                'type' => LogTypes::DeleteUser
            ]);

            DB::table('logs')->where('user_id', $id)->delete();
            Permission::where('user_id', $id)->delete();

            $user->delete();

            DB::commit();


            if(app()->getLocale() === 'en')
                return redirect()->back()->with('success', 'Deleted successfully.');
            else
                return redirect()->back()->with('success', 'حذف بنجاح.');
        } catch (\Exception $e) {
            logger($e->getMessage());
            DB::rollBack();
            if(app()->getLocale() === 'en')
                return redirect()->back()->with('error', 'Error deleting user and related records: ' . $e->getMessage());
            else
                return redirect()->back()->with('error', 'خطأ في حذف المستخدم والسجلات ذات الصلة' . $e->getMessage());
        }
    }

    public function deletePromoter($id){
        $promoter = Promoter::findOrFail($id);
        $actions = [
            'en' => 'Has deleted a promoter with name : ' . $promoter->name,
            'ar' => 'حذف مروج باسم:  ' . $promoter->name,
        ];
        Log::create([
            'user_id' => Auth::id(),
            'action' => $actions,
            'type' => LogTypes::DeletePromoter
        ]);
        $promoter->delete();

        if(app()->getLocale() === 'en')
                return redirect()->back()->with('success', 'Deleted successfully.');
            else
                return redirect()->back()->with('success', 'حذف بنجاح.');

    }

    public function settings()
    {
        $user = Auth::user();

        $settings = CentralSetting::first();

        $live_chat_enabled = $settings?->live_chat_enabled;
        $webhook_url = $settings?->webhook_url;
        $new_branch_slot_price = $settings?->new_branch_slot_price;
        $active_days_after_sub_expired = $settings?->active_days_after_sub_expired;


        return view('admin.settings', compact('user', 'live_chat_enabled', 'webhook_url', 'new_branch_slot_price','active_days_after_sub_expired'));
    }

    public function saveSettings(Request $request)
    {
        $settings = CentralSetting::first();

        $settings->live_chat_enabled = strtolower($request->live_chat_enabled) == 'on';
        $settings->webhook_url = $request->webhook_url;
        $settings->active_days_after_sub_expired = $request->active_days_after_sub_expired ?? 7;
        $settings->save();
        $actions = [
            'en' => 'Update platform central settings',
            'ar' => 'عدل علي اعدادات المنصة'
        ];
        Log::create([
            'user_id' => Auth::id(),
            'action' => $actions,
            'metadata' => $request->all(),
            'type' => LogTypes::UpdateSettings
        ]);

        if (app()->getLocale() === 'en')
            return redirect()->back()->with('success', 'Save settings successfully.');
        else
            return redirect()->back()->with('success', "حفظ الاعدادات بنجاح");
    }

    public function userManagement()
    {
        $admins = User::whereHas('roles',function($q){
            return $q->where("name","Administrator");
        })
        ->where('id','!=',Auth::id())
        ->orderBy('id','DESC')
        ->paginate(15);
        $user = Auth::user();
        return view('admin.user-management', compact('user', 'admins'));
    }

    public function orderInquiry(Request $request)
    {
        $order = null;
        $orderStatusLogs = null;
        $locale = app()->getLocale();
        $user = Auth::user();

        if ($request->has('order_id')) {
            $validatedData = $request->validate([
                'order_id' => 'required|string|min:12|max:12',
            ], [
                'order_id.required'=>__("Order id is required"),
                'order_id.min' => __('Enter valid Order id consists of 12 characters'),
                'order_id.max' => __('Enter valid Order id consists of 12 characters')
            ]);

            $order_id = $validatedData['order_id'];
            $tenant_id = getTenantByOrderId($order_id)?->id;

            $restaurant = Tenant::findOrFail($tenant_id);

            $restaurant->run(function() use (&$order, &$orderStatusLogs, $order_id){
                $order = Tenant\Order::with(
                    'payment_method', 'branch', 'delivery_type', 'user',
                    'items', 'items.item', 'coupon'
                )->where('id', '=', $order_id)?->first();

                $orderStatusLogs = OrderStatusLogs::all()->where('order_id', '=', $order?->id)?->sortByDesc("created_at");
            });
        }

        return view('admin.order-inquiry', compact('user','order', 'locale', 'orderStatusLogs'));
    }

    public function restaurantOwnerManagement(Request $request)
    {
        $admins = User::whenType($request['type']??null)
            ->where('id','!=',1)
            ->orderBy('id','desc')
            ->paginate(config('application.perPage')??20);
        $user = Auth::user();
        return view('admin.restaurant-owner-management', compact('user', 'admins'));
    }

    public function userManagementEdit($id){

        $user = Auth::user();
        $userEdit = User::whereHas('roles',function($q){
            return $q->where("name","Administrator");
        })->where("id",'!=',Auth::id())->findOrFail($id);
        return view('admin.edit-user', compact('user','userEdit'));

    }

    public function updateUserPermissions(Request $request, $userId){

        $selectedUser = User::whereHas('roles',function($q){
            return $q->where("name","Administrator");
        })->where("id",'!=',Auth::id())->findOrFail($userId);

        $selectedUser->first_name = $request->input('first_name');
        $selectedUser->last_name = $request->input('last_name');
        $selectedUser->phone = $request->input('phone');
        $selectedUser->email = $request->input('email');

        if ($request->has('password')) {
            $selectedUser->password = Hash::make($request->input('password'));
        }

        $permissions = [
            'can_access_restaurants',
            'can_view_restaurants',
            'can_approve_restaurants',
            'can_see_admins',
            'can_edit_admins',
            'can_add_admins',
            'can_promoters',
            'can_see_logs',
            'can_settings',
            'can_edit_profile',
            'can_delete_restaurants',
            'can_see_restaurant_owners',
            'can_manage_notifications_receipt'

        ];

        $updateData = [];

        foreach ($permissions as $permission) {
            $updateData[$permission] = $request->has($permission) ? 1 : 0;
        }
        $updateData['can_access_dashboard'] = 1;
        DB::table('permissions')
            ->where('user_id', $userId)
            ->update($updateData);

        $selectedUser->save();

        $user = Auth::user();
        $actions = [
            'en' => 'Has edited profile and permissions for an user with ID of: ' . $userId,
            'ar' => 'عدل علي صلاحيات المستخدم المعرف ب: ' . $userId,
        ];
        Log::create([
            'user_id' => Auth::id(),
            'action' => $actions,
            'type'  => LogTypes::UpdateUserPermissions
        ]);

        if(app()->getLocale() === 'en')
            return redirect()->route('admin.user-management')->with([
                'success' => 'User updated successfully',
            ])->with(compact('user'));
        else
            return redirect()->route('admin.user-management')->with([
                'success' => 'User updated successfully',
            ])->with(compact('user'));
    }

    public function giveUnapprovedUsers(){

        $unapprovedUsers = User::where('isApproved', 0)
        ->where('role', 0)
        ->whereNotNull('commercial_registration_pdf')
        ->whereNotNull('signed_contract_delivery_company')
        ->whereNotNull('email_verified_at')
        ->paginate(15);

        $loggedUser = Auth::user();

        return view('admin.unapproved', compact('unapprovedUsers', 'loggedUser'));
    }

    public function approveUser($id)
    {
        $user = User::find($id);

        $user->status = User::STATUS_ACTIVE;
        $user->reject_reasons = null;
        $user->save();

        // set user status in tenant table too
        $tenant = Tenant::findOrFail($user?->id);

        $tenant->run(function () use($user){
            $rUser = RestaurantUser::where('email', '=', $user?->email)->first();
            $rUser->status = RestaurantUser::ACTIVE;
            $rUser->reject_reasons = null;
            $rUser->save();
        });

        SendApprovedEmailJob::dispatch($user);

        $loggedUser = Auth::user();
        $actions = [
            'en' => 'Has approved an user with an ID of: ' . $id,
            'ar' => 'تم الموافقة علي مستخدم بمعرف :' . $id,
        ];
        Log::create([
            'user_id' => Auth::id(),
            'action' => $actions,
            'type'  =>  LogTypes::ApproveUser
        ]);

        if(app()->getLocale() === 'en')
            return redirect()->back()->with([
                'success' => 'User approved successfully',
            ])->with(compact('loggedUser'));
        else
            return redirect()->back()->with([
                'success' => 'تم تحديث المسوؤل بنجاح',
            ])->with(compact('loggedUser'));

    }

    public function denyUser(Request $request, $id)
    {
        $tenant = Tenant::findOrFail($id);
        $user = User::find($tenant->user_id);

        if (!$user) {
            return redirect()->back()->with('error', __('Invalid user'));
        }

        $selectedOption = $request->input('options');

        if($selectedOption == null){
            return redirect()->back()->with('error', __('You have to select one option at least!'));
        }

        if ($user?->email == env('SUPER_MASTER_ADMIN_EMAIL')) {
            return redirect()->back()->with('error', __('Super master admin can not blocked'));
        }

        if ($user) {
            $user->status = User::STATUS_REJECTED;
            $user->reject_reasons = json_encode($selectedOption);
            $user->save();

            // set user status in tenant table too
            $tenant->run(function () use($user, $selectedOption){
                $rUser = RestaurantUser::where('email', '=', $user?->email)->first();
                $rUser->status = RestaurantUser::REJECTED;
                $rUser->reject_reasons = json_encode($selectedOption);
                $rUser->save();
            });
        }

        SendDeniedEmailJob::dispatch($user, $selectedOption);
        $actions = [
            'en' => 'Has denied an restaurant with an ID of: '."<a href=".route('admin.view-restaurants',['tenant'=>$tenant->id])."> $tenant->id </a>",
            'ar' => 'رفض مطعم بمعرف: '."<a href=".route('admin.view-restaurants',['tenant'=>$tenant->id])."> $tenant->id </a>",
        ];
        Log::create([
            'user_id' => Auth::id(),
            'action' => $actions,
            'type' => LogTypes::DenyRestaurant,
            'metadata' => ['reason' => $selectedOption]
        ]);

        return redirect()->back()->with([
            'success' => __('Restaurant rejected successfully'),
            'user' => Auth::user()
        ]);
    }

    public function downloadCommercialRegistration($filename){
        $filePath = 'private/commercial_registration/' . $filename;
        $file = Storage::disk('local')->get($filePath);

        if ($file) {
            $actions = [
                'en' => 'Has downloaded a commercial registration file with a filename of: ' . $filename,
                'ar' => 'قام بتنزيل ملف سجل تجاري باسم الملف: ' . $filename,
            ];
            Log::create([
                'user_id' => Auth::id(),
                'action' => $actions,
                'type' => LogTypes::DownloadCommercialFile
            ]);
            return response()->download(storage_path('app/' . $filePath), $filename);
        } else {
            abort(404, 'File not found');
        }

    }

    public function downloadDeliveryContract($filename){
        $filePath = 'private/delivery_contract/' . $filename;
        $file = Storage::disk('local')->get($filePath);

        if ($file) {
            $actions = [
                'en' => 'Has downloaded a delivery contract file with a filename of: ' . $filename,
                'ar' => 'قام بتنزيل ملف عقد التسليم باسم ملف: ' . $filename,
            ];
            Log::create([
                'user_id' => Auth::id(),
                'action' => $actions,
                'type' => LogTypes::DownloadDeliveryContract
            ]);
            return response()->download(storage_path('app/' . $filePath), $filename);
        } else {
            abort(404, 'File not found');
        }

    }

    public function downloadTaxNumber($filename){
        $filePath = 'private/tax_number/' . $filename;
        $file = Storage::disk('local')->get($filePath);

        if ($file) {
            $actions = [
                'en' => 'Has downloaded a tax number file with a filename of: ' . $filename,
                'ar' => 'قام بتنزيل ملف الرقم الضريبي باسم ملف: ' . $filename,
            ];
            Log::create([
                'user_id' => Auth::id(),
                'action' => $actions,
                'type' => LogTypes::DownloadTaxNumber,
            ]);
            return response()->download(storage_path('app/' . $filePath), $filename);
        } else {
            abort(404, 'File not found');
        }

    }

    public function downloadBankCertificate($filename){
        $filePath = 'private/bank_certificate/' . $filename;
        $file = Storage::disk('local')->get($filePath);

        if ($file) {
            $actions = [
                'en' => 'Has downloaded a bank certificate file with a filename of: ' . $filename,
                'ar' => 'قام بتنزيل ملف شهادة بنكية باسم ملف: ' . $filename,
            ];
            Log::create([
                'user_id' => Auth::id(),
                'action' => $actions,
                'type' => LogTypes::DownloadBankCertificate
            ]);
            return response()->download(storage_path('app/' . $filePath), $filename);
        } else {
            abort(404, 'File not found');
        }

    }

    public function toggleStatus(User $user)
    {
        // Toggle the user status
        if($user->id==1)return response()->json(['message' => 'Unauthorized']);
        $user->update(['status' => ($user->isBlocked())?'active':'blocked']);

        return response()->json(['isBlocked' => $user->isBlocked()]);
    }
    public function subscriptions(){
        $user = Auth::user();

        if ($user?->email !== env('SUPER_MASTER_ADMIN_EMAIL')) {
            return redirect()->back()->with('error', __('You are not allowed to access this page'));
        }

        $subscriptions = Subscription::all();
        return view('admin.subscriptions', compact('subscriptions','user'));
    }
    // public function subscriptionsCreate(){
    //     $user = Auth::user();
    //     return view('admin.subscriptions-create', compact('user'));
    // }
    // public function subscriptionsStore(Request $request){
    //     Subscription::create([
    //         'name'=>trans_json($request->name_en,$request->name_ar),
    //         'amount'=>$request->amount
    //     ]);
    //     return redirect()->route('admin.subscriptions')->with([
    //         'success' => __("A new Subscription has been created"),
    //     ]);
    // }
    public function subscriptionShow(Subscription $subscription){
        $user = Auth::user();
        return view('admin.subscriptions-edit', compact('user','subscription'));
    }
    public function subscriptionUpdate(Subscription $subscription,Request $request){
        $request->validate([
            'name_en'=>"required|string",
            'name_ar'=>"required|string",
            'description_ar'=>"required|string",
            'description_en'=>"required|string",
        ]);
        $subscription->update([
            'name'=>trans_json($request->name_en ?? '',$request->name_ar ?? ''),
            'description'=>trans_json($request->description_en ?? '',$request->description_ar ?? ''),
            'amount'=>$request->amount
        ]);
        return redirect()->route('admin.subscriptions')->with([
            'success' => __("Subscription has been updated"),
        ]);
    }
}
