<?php

namespace App\Http\Controllers;

use App\Jobs\SendApprovedEmailJob;
use App\Jobs\SendApprovedRestaurantEmailJob;
use App\Models\CentralSetting;
use App\Models\Tenant\Setting as TenantSettings;
use App\Models\Tenant;
use App\Models\Tenant\RestaurantUser;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Contracts\Mail\Mailable;
use Illuminate\Support\Facades\Mail;
use App\Mail\DeniedEmail;
use App\Mail\ApprovedEmail;
use App\Mail\ApprovedRestaurant;
use App\Models\User;
use App\Models\Log;
use App\Models\Promoter;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;

class AdminController extends Controller
{
    public function dashboard()
    {
        $user = Auth::user();

        //
        $restaurantsAll = Tenant::with("primary_domain")->get();

        // not complete register step2
        $restaurantsOwnersNotUploadFiles = User::doesntHave('traderRegistrationRequirement')->count();

        $restaurantsLive = 0;
        $customers = 0;

        foreach ($restaurantsAll as $restaurant) {
            $restaurant->run(static function ($tenant) use (&$restaurantsLive, &$customers) {
                $setting = TenantSettings::first();
                if ($setting->is_live) {
                    $restaurantsLive ++;
                }

                $currentMonth = Carbon::now()->month;
                $customers+= RestaurantUser::customers()->whereMonth('created_at', '=', $currentMonth)->count();
            });
        }
        $restaurantsAll = count($restaurantsAll);



        return view('admin.dashboard', compact('user',
            'restaurantsAll', 'restaurantsOwnersNotUploadFiles',
            'restaurantsLive', 'customers'
        ));
    }

    public function addUser()
    {
        $user = Auth::user();

        return view('admin.add-user', compact('user'));
    }

    public function revenue()
    {
        $user = Auth::user();


        if ($user?->email !== env('SUPER_MASTER_ADMIN_EMAIL')) {
            return redirect()->back()->with('error', __('You are not allowed to access this page'));
        }

        return view('admin.revenue', compact('user'));
    }

    public function promoters(){

        $promoters = Promoter::paginate(15);

        $user = Auth::user();
        return view('admin.promoters', compact('user', 'promoters'));
    }

    public function addPromoter(Request $request){

        $name = $request['name'];
        $url = $request['url'];
        if(is_null($url)){
            $newURL = Str::random(16);
            while (DB::table('promoters')->where('url', $newURL)->exists()) {
                $newURL = Str::random(16);
            }
            $url = $newURL;
        }

        if(DB::table('promoters')->where('url', $url)->exists()){

            if(app()->getLocale() === 'en')
                return redirect()->back()->with('error', 'URL already exists!');
            else
                return redirect()->back()->with('error', 'هذا الرابط موجود');
        }

        $insertData = [];
        $insertData['url'] = $url;
        $insertData['name'] = $name;
        $insertData['user_id'] = Auth::user()->id;
        $insertData['created_at'] = now();
        $insertData['updated_at'] = now();

        DB::table('promoters')->insert($insertData);

        Log::create([
            'user_id' => Auth::id(),
            'action' => 'Made a promoter with an ID of: ' . DB::table('promoters')->where('url', $url)->value('id'),
        ]);

        if(app()->getLocale() === 'en')
            return redirect()->back()->with('success', 'Promoter added successfully');
        else
            return redirect()->back()->with('success', 'تمت إضافة المروج بنجاح');

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
        ];

        $insertData = [];

        foreach ($permissions as $permission) {
            $insertData[$permission] = $request->has($permission) ? 1 : 0;
        }

        $insertData['user_id'] = $user->id;
        $insertData['can_access_dashboard'] = 1;

        DB::table('permissions')->insert($insertData);

        Log::create([
            'user_id' => Auth::id(),
            'action' => 'Made an user with an ID of: ' . $user->id,
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

        Log::create([
            'user_id' => Auth::id(),
            'action' => 'Has edited his profile.',
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

    public function viewRestaurant($id){

        $restaurant = Tenant::findOrFail($id);//->with('user.traderRegistrationRequirement');
        $logo =null;
        $is_live= false;

        $restaurant->run(static function($restaurant)use(&$logo,&$is_live){
            $info = $restaurant->info(false);
            $logo = $info['logo'];
            $is_live = $info['is_live'];
        });

        $owner =  $restaurant->user;
        $widget = 'overview';
        $user = Auth::user();
        // if($restaurant->role == 0){
        //     return view('admin.view-restaurant', compact('restaurant'));
        // }else{
        //     return abort(404);
        // }

        return view('admin.view-restaurant', compact('restaurant','widget','user','logo','is_live','owner'));

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

        SendApprovedRestaurantEmailJob::dispatch($restaurant);

        Log::create([
            'user_id' => Auth::id(),
            'action' => 'Has activate restaurant with an ID of: ' . "<a href=".route('admin.view-restaurants',['id'=>$restaurant->id])."> $restaurant->id </a>",
        ]);

        return redirect()->route('admin.view-restaurants',['id'=>$restaurant->id])->with('success', __("Restaurant has been activated successfully."));

    }

    public function viewRestaurantOrders( $id){

        $restaurant = Tenant::findOrFail($id);
        $logo =null;
        $is_live= false;
        $orders = [];
        $restaurant->run(static function($restaurant)use(&$logo,&$is_live,&$orders){
            $info = $restaurant->info(false);
            $logo = $info['logo'];
            $is_live = $info['is_live'];
            $orders = $restaurant->orders(false);
        });
        $owner =  $restaurant->user;
        $user = Auth::user();
        $widget = 'orders';

        return view('admin.view-restaurant-orders', compact('user','widget','owner','restaurant', 'orders','is_live','logo'));
    }

    public function viewRestaurantCustomers( $id){

        $restaurant = Tenant::findOrFail($id);
        $is_live = false;
        $logo = null;

        $customers =[];
        $restaurant->run(static function($restaurant)use(&$logo,&$is_live,&$customers){
            $info = $restaurant->info(false);
            $logo = $info['logo'];
            $is_live = $info['is_live'];
            $customers = $restaurant->customers(false);
        });
        $owner =  $restaurant->user;
        $user = Auth::user();
        $widget = 'customers';

        return view('admin.view-restaurant-customers', compact('user','widget','owner','logo','restaurant', 'customers','is_live'));
    }

    public function deleteRestaurant($id)
    {

        //
        User::findOrFail($id)->delete();

            Log::create([
                'user_id' => Auth::id(),
                'action' => 'Has deleted a restaurant with an ID of: ' . $id,
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

            Log::create([
                'user_id' => Auth::id(),
                'action' => 'Has deleted an user with an ID of: ' . $id,
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
        Log::create([
            'user_id' => Auth::id(),
            'action' => 'Has deleted a promoter with an ID of: ' . $id,
        ]);

        DB::table('promoters')->where('id', $id)->delete();

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

        return view('admin.settings', compact('user', 'live_chat_enabled', 'webhook_url'));
    }

    public function saveSettings(Request $request)
    {
        $settings = CentralSetting::first();

        $settings->live_chat_enabled = strtolower($request->live_chat_enabled) == 'on';
        $settings->webhook_url = $request->webhook_url;
        $settings->save();

        Log::create([
            'user_id' => Auth::id(),
            'action' => 'Update platform central settings',
            'metadata' => json_encode($request->all())
        ]);

        if(app()->getLocale() === 'en')
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
        ->paginate(15);
        $user = Auth::user();
        return view('admin.user-management', compact('user', 'admins'));
    }

    public function restaurantOwnerManagement()
    {
        $admins = User::whereHas('roles',function($q){
            return $q->where("name","Restaurant Owner");
        })
        ->paginate(15);
        $user = Auth::user();
        return view('admin.restaurant-owner-management', compact('user', 'admins'));
    }

    public function userManagementEdit($id){

        $user = User::whereHas('roles',function($q){
            return $q->where("name","Administrator");
        })->where("id",'!=',Auth::id())->findOrFail($id);

        return view('admin.edit-user', compact('user'));

    }

    public function logs(Request $request)
    {

        $query = DB::table('logs')->orderBy('created_at', 'desc');

        if ($request->filled('user_id')) {
            if ($request->input('user_id') != 'all') {
                $query->where('user_id', $request->input('user_id'));
            }
        }

        if ($request->filled('action')) {
            if ($request->input('action') != 'all') {
                $query->where('action', 'LIKE', '%' . $request->input('action') . '%');
            }
        }

        $owners = User::get();
        $user = Auth::user();
        $logs = $query->paginate(25);

        return view('admin.logs', compact('user', 'logs', 'owners'));
    }

    public function updateUserPermissions(Request $request, $userId){

        $selectedUser = User::whereHas('roles',function($q){
            return $q->where("name","Administrator");
        })->where("id",'!=',Auth::id())->findOrFail($userId);

        $selectedUser->first_name = $request->input('first_name');
        $selectedUser->last_name = $request->input('last_name');
        $selectedUser->phone = $request->input('phone');
        $selectedUser->email = $request->input('email');

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

        Log::create([
            'user_id' => Auth::id(),
            'action' => 'Has edited profile and permissions for an user with ID of: ' . $userId,
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

        if ($user) {
            $user->isApproved = 1;
            $user->save();
        }

        SendApprovedEmailJob::dispatch($user);

        $loggedUser = Auth::user();

        Log::create([
            'user_id' => Auth::id(),
            'action' => 'Has approved an user with an ID of: ' . $id,
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
        $user = User::find(
            Tenant::findOrFail($id)?->user_id
        );

        if (!$user) {
            return redirect()->back()->with('error', __('Invalid user'));
        }

        $selectedOption = $request->input('options');

        if($selectedOption == null){
            return redirect()->back()->with('error', 'You have to select one option at least!');
        }

        if ($user?->email == env('SUPER_MASTER_ADMIN_EMAIL')) {
            return redirect()->back()->with('error', __('Super master admin can not blocked'));
        }

        if ($user) {
            $user->status = User::STATUS_BLOCKED;
            $user->save();
        }

        Mail::to($user->email)->queue(new DeniedEmail($user, $selectedOption));

        Log::create([
            'user_id' => Auth::id(),
            'action' => 'Has denied an user with an ID of: ' . $id,
            'reason' => $selectedOption
        ]);

        return redirect()->back()->with([
            'success' => 'User denied successfully',
            'user' => Auth::user()
        ]);
    }

    public function downloadCommercialRegistration($filename){
        $filePath = 'private/commercial_registration/' . $filename;
        $file = Storage::disk('local')->get($filePath);

        if ($file) {
            Log::create([
                'user_id' => Auth::id(),
                'action' => 'Has downloaded a commercial registration file with a filename of: ' . $filename,
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
            Log::create([
                'user_id' => Auth::id(),
                'action' => 'Has downloaded a delivery contract file with a filename of: ' . $filename,
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
            Log::create([
                'user_id' => Auth::id(),
                'action' => 'Has downloaded a tax number file with a filename of: ' . $filename,
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
            Log::create([
                'user_id' => Auth::id(),
                'action' => 'Has downloaded a bank certificate file with a filename of: ' . $filename,
            ]);
            return response()->download(storage_path('app/' . $filePath), $filename);
        } else {
            abort(404, 'File not found');
        }

    }

    public function toggleStatus(User $user)
    {
        // Toggle the user status
        $user->update(['status' => ($user->isBlocked())?'active':'blocked']);

        return response()->json(['isBlocked' => $user->isBlocked()]);
    }

}
